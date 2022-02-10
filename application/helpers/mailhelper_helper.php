<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('simpleMail')){
   function simpleMail($to=null,$subject=null,$MailBodyForSendMail=null){
   		$config = array(
          'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
          'smtp_host' => 'smtp.office365.com', 
          'smtp_port' => '587',
          'smtp_user' => 'ttlr@tendertouch.com',
          'smtp_pass' => 'xng7ypn#vw!',
          'smtp_crypto' => 'ssl',
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
      );
   			$CI =& get_instance();
     		$CI->load->library('email', $config);

            $CI->email->clear(TRUE);
            $CI->email->set_newline("\r\n");
            $CI->email->from('ttlr@tendertouch.com', 'Leave Application');
            $CI->email->to($to);
            $CI->email->subject($subject);
            $CI->email->set_mailtype('html');
			//$this->email->set_mailtype("html");

            $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
                <meta name="viewport" content="width=device-width" />
                
                <title>Actionable emails e.g. reset password</title>
                <style>
                  * {
                  margin: 0;
                  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                  box-sizing: border-box;
                  font-size: 14px;
                  }
                  body {
                  -webkit-font-smoothing: antialiased;
                  -webkit-text-size-adjust: none;
                  width: 100% !important;
                  height: 100%;
                  line-height: 1.6em;
                  }
                  body { background-color: #f6f6f6; }
                  .body-wrap { background-color: #f6f6f6; width: 100%; }
                  .container {
                  display: block !important;
                  max-width: 600px !important;
                  margin: 0 auto !important;
                  clear: both !important;
                  }
                  a { color: #348eda; text-decoration: underline; }
                  .btn-primary {
                  text-decoration: none;
                  color: #FFF;
                  background-color: #348eda;
                  border: solid #348eda;
                  border-width: 10px 20px;
                  line-height: 2em;
                  font-weight: bold;
                  text-align: center;
                  cursor: pointer;
                  display: inline-block;
                  border-radius: 5px;
                  text-transform: capitalize;
                  }
                </style>
              </head>
              <body itemscope itemtype="http://schema.org/EmailMessage">
              '.$MailBodyForSendMail.'
			</body>
			</html>';
	           
	        $CI->email->message($body);
			if($CI->email->send()){
        $msg = 'Mail Send Successfully to '.$to;
				return $msg;
			} else{
        $msg = 'Mail Send Error to '.$to. " Mail Error: ".$CI->email->print_debugger();
        return $msg;
				// return $CI->email->print_debugger();
			} 
   }

   /*Punch Request mail helper */
   /*Start punch Request */

   function simpleMail_punch($email_info=array(),$to=null,$subject=null,$MailBodyForSendMail=null){
      $config = array(
          'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
          // 'smtp_host' => 'smtp.office365.com', 
          // 'smtp_port' => '587',
          // 'smtp_user' => 'timeandattendance@tendertouch.com',
          // 'smtp_pass' => 'F8?&t3esp-s2cRitHe1h',
          'smtp_host' => $email_info['host'], 
          'smtp_port' => $email_info['port'],
          'smtp_user' => $email_info['username'],
          'smtp_pass' => $email_info['password'],
          'smtp_crypto' => 'ssl',
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
      );
        $CI =& get_instance();
        $CI->load->library('email', $config);

            $CI->email->clear(TRUE);
            $CI->email->set_newline("\r\n");
            // $CI->email->from('benefits@tendertouch.com', 'Punch Request');
            $CI->email->from($email_info['from_email'], $email_info['email_title']);
            $CI->email->to($to);
            $CI->email->subject($subject);
            $CI->email->set_mailtype('html');
      //$this->email->set_mailtype("html");

            $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
                <meta name="viewport" content="width=device-width" />
                
                <title>Actionable emails e.g. reset password</title>
                <style>
                  * {
                  margin: 0;
                  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                  box-sizing: border-box;
                  font-size: 14px;
                  }
                  body {
                  -webkit-font-smoothing: antialiased;
                  -webkit-text-size-adjust: none;
                  width: 100% !important;
                  height: 100%;
                  line-height: 1.6em;
                  }
                  body { background-color: #f6f6f6; }
                  .body-wrap { background-color: #f6f6f6; width: 100%; }
                  .container {
                  display: block !important;
                  max-width: 600px !important;
                  margin: 0 auto !important;
                  clear: both !important;
                  }
                  a { color: #348eda; text-decoration: underline; }
                  .btn-primary {
                  text-decoration: none;
                  color: #FFF;
                  background-color: #348eda;
                  border: solid #348eda;
                  border-width: 10px 20px;
                  line-height: 2em;
                  font-weight: bold;
                  text-align: center;
                  cursor: pointer;
                  display: inline-block;
                  border-radius: 5px;
                  text-transform: capitalize;
                  }
                </style>
              </head>
              <body itemscope itemtype="http://schema.org/EmailMessage">
              '.$MailBodyForSendMail.'
      </body>
      </html>';
             
          $CI->email->message($body);
      if($CI->email->send()){
        $msg = 'Mail Send Successfully to '.$to;
        return $msg;
      } else{
        $msg = 'Mail Send Error to '.$to. " Mail Error: ".$CI->email->print_debugger();
        return $msg;
        // return $CI->email->print_debugger();
      } 
   }
      /*End punch Request */
}
