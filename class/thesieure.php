<?php 
    /*
        * Developer Class by CMSNT Thiên Ân *


        $tsr = new Thesieure();
        $tsr->username = $CMSNT->site('tk_tsr');
        $tsr->password = $CMSNT->site('mk_tsr');
        $tsr->passwordc2 = $CMSNT->site('mk2_tsr');
        $tsr->noidungnap = $CMSNT->site('noidung_naptien');
        $data = json_decode($tsr->Naptien($magiaodich), true);

    */

    class Thesieure {

        //
        public $username = '';
        public $password = '';
        public $passwordc2 = '';
        public $noidungnap = '';

        //
        private $cookie = '';
        private $cache = [];
        private $token = '';
        private $lichsunap = [];
        public $error = 'NULL';


        public function Naptien($magiaodich)
        {
            $this->History_Napthe();

            $status = false;
            $message = 'Không tìm thấy giao dịch';
            $data = [];

            foreach ( $this->lichsunap as $row ) {
                if ( $row['magiaodich'] == $magiaodich ) {
                    $status = true;
                    $message = 'Giao dịch thành công';
                    $data = $row;
                }
            }

            $build = [
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ];

            return json_encode($build);
        }

        private function Login()
        {
            $this->GetToken('https://thesieure.com/account/login');

            $url = 'https://thesieure.com/account/login';
            $cookie = $this->cookie;
            $post = [
                '_token' => $this->token,
                'phoneOrEmail' => $this->username,
                'password' => $this->password,
            ];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
            curl_setopt($curl, CURLOPT_HEADER, 1);
            if ($post) curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
            $result = curl_exec($curl);
            curl_close($curl);

            $cookie = '';
            preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
            foreach($matches[1] as $x) {
                $cookie .= $x.';';
            }
            $cookie = substr($cookie, 0, strlen($cookie) - 1);
            $this->cookie = $cookie ?? $this->cookie;

            $data = $result;

            if ( strpos($data, '<title>Redirecting to https://thesieure.com</title>') !== false ) {
                return true;
            } else {
                $this->error = 'Bạn chưa đăng nhập';
                return false;
            }
        }

        private function GetToken($x)
        {
            $url = $x;
            $cookie = $this->cookie;
            $post = [];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 1);
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
            if ($post) curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
            $result = curl_exec($curl);

            $cookie = '';
            preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
            foreach($matches[1] as $x) {
                $cookie .= $x.';';
            }
            $cookie = substr($cookie, 0, strlen($cookie) - 1);
            
            $this->cookie = $cookie ?? $this->cookie;
            $this->token = explode('"', explode('<meta name="csrf-token" content="', $result)[1])[0] ?? $this->token;
            return $result;
        }

        private function History_Napthe()
        {
            //
            $login = $this->Login();

            //
            if ($login) {
                //return $this->cookie;
                $url = 'https://thesieure.com/wallet/history/vnd';
                $cookie = $this->cookie;
                $post = [];

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_COOKIE, $cookie);
                if ($post) curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
                $data = curl_exec($curl);
                curl_close($curl);
                
                $this->lichsunap = [];
                $stt = 0;

                $form = explode('</tbody>', explode('<tbody>', $data)[1] )[0];

                $x = explode('<tr>', $form);

                foreach( $x as $code )
                {
                    $j = explode('</tr>', $code)[0];
                    
                    $sotien = explode('<td>', explode('<td>', $j)[3])[0];

                    if ( strpos($sotien, 'success') !== false && strpos($sotien, '+') !== false ) {
                        
                        //
                        $sotien2 = explode('<b>+', $sotien)[1];
                        $sotien2 = explode('đ', $sotien2)[0];
                        $sotienthat = filter_var($sotien2, FILTER_SANITIZE_NUMBER_INT);

                        //
                        $magiaodich = explode('<td>', explode('<td>', $j)[1])[0];
                        $magiaodich = explode('</td>', $magiaodich)[0];

                        //
                        $noidungchuyen = explode('<td>', explode('<td>', $j)[7])[0];
                        $noidungchuyen = explode('</td>', $noidungchuyen)[0];
                        $mnoidungchuyen = explode('|', $noidungchuyen)[0];

                        //
                        $time = explode('<td>', explode('<td>', $j)[6])[0];
                        $time = explode('</td>', $time)[0];

                        //
                        if ( $this->noidungnap == $mnoidungchuyen ) {
                            $this->lichsunap[$stt] = [
                                'magiaodich' => $magiaodich,
                                'sotien' => $sotienthat,
                                'noidung' => $mnoidungchuyen,
                                'time' => $time,
                            ];

                            $stt ++;
                        }


                    }

                }

                return $this->lichsunap;
            } else {
                $this->error = 'Bạn chưa đăng nhập';
                return false;
            }
        }

    }
