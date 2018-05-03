<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function email($toemail,$title,$content){
    $mail = new \PHPMailer();
    $mail->isSMTP();// 使用SMTP服务
    $mail->CharSet = "utf8";// 编码格式为utf8，不设置编码的话，中文会出现乱码
    $mail->Host = "smtp.exmail.qq.com";// 发送方的SMTP服务器地址
    $mail->SMTPAuth = true;// 是否使用身份验证
    $mail->Username = "rain@rain1024.com";// 发送方的163邮箱用户名，就是你申请163的SMTP服务使用的163邮箱</span><span style="color:#333333;">
    $mail->Password = "";// 发送方的邮箱密码，注意用163邮箱这里填写的是“客户端授权密码”而不是邮箱的登录密码！</span><span style="color:#333333;">
    $mail->From = "rain@rain1024.com"; //发件人地址（也就是你的邮箱地址）
    $mail->SMTPSecure = "ssl";// 使用ssl协议方式</span><span style="color:#333333;">
    $mail->Port = 465;// 163邮箱的ssl协议方式端口号是465/994
    $mail->FromName = 'ring';// 设置发件人信息，如邮件格式说明中的发件人，这里会显示为Mailer(xxxx@163.com），Mailer是当做名字显示
    $mail->AddAddress($toemail,'用户');// 设置收件人信息，如邮件格式说明中的收件人，这里会显示为Liang(yyyy@163.com)
    // $mail->addReplyTo("","Reply");// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
    //$mail->addCC("xxx@163.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)
    //$mail->addBCC("xxx@163.com");// 设置秘密抄送人(这个人也能收到邮件)
    //$mail->addAttachment("bug0.jpg");// 添加附件
    $mail->Subject = "小Q资源网邮件回复!";// 邮件标题
    $mail->Body = "以下是小Q网络资源博客博主回复你的内容:点击可以查看文章地址:";// 邮件正文
    //$mail->AltBody = "This is the plain text纯文本";// 这个是设置纯文本方式显示的正文内容，如果不支持Html方式，就会用到这个，基本无用

    if(!$mail->send()){// 发送邮件
        return $mail->ErrorInfo;
        // echo "Message could not be sent.";
        // echo "Mailer Error: ".$mail->ErrorInfo;// 输出错误信息
    }else{
        return 1;
    }
}
/** IP地址查询接口函数
 * @param $ip IP地址
 */
function ip_select($ip){
//        $ip = '27.189.201.108';
    $datatype = 'txt';
    $url = 'http://api.ip138.com/query/?ip='.$ip.'&datatype='.$datatype;
    $header = array('token:d5dd821801f23acef2a763e49d3c492f');
//        echo getData($url,$header);
//        function getData($url,$header){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3);
    $handles = curl_exec($ch);
    curl_close($ch);
    return $handles;
}
