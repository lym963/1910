<?php
//无限极分类
function getCategoryInfo($res,$pid=0,$level=1)
{
    static $info=[];
    foreach($res as $k=>$v){
        if($v["pid"]==$pid){
            $v['level']=$level;
            $info[]=$v;
            getCategoryInfo($res,$v["cate_id"],$v["level"]+1);
        }
    }
    return $info;
}
//无限极分类查询所有顶级分类下子孙分类的cate_id
function getCateId($array,$pid)
{
    static $c_id=[];
    $c_id[$pid]=$pid;
    foreach($array as $k=>$v){
        if($v["pid"]==$pid){
            //获取id
            $c_id[$v["cate_id"]]=$v["cate_id"];
            //调用自身方法
            $c_id=getCateId($array,$v["cate_id"]);
             
        }
    }
    return $c_id;
}
//文件上传
function upload($img)
{
    if(request()->file($img)->isValid()){
        $file=request()->$img;
        $path=$file->store("uploads");
        return $path;
    }
    exit("上传文件出错！");
}
//多文件上传
function uploads($imgs)
{
    $file=request()->$imgs;
    //判断是否是数组
    if(!is_array($file)){
        return ;
    }
    //循环
    foreach($file as $k=>$v){
        $path[$k]=$v->store("uploads");
    }
    //将数组转为字符串
    $path=implode("|",$path);
    return $path;
}
//发送短信
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
function sendMobile($mobile,$code)
{
    // Download：https://github.com/aliyun/openapi-sdk-php
    // Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

    AlibabaCloud::accessKeyClient('LTAI4G8sw63UUm5ieUhsuaWR', 'Hn07p2xcLym3RPcenDdQuArkhahGUE')
                            ->regionId('cn-hangzhou')
                            ->asDefaultClient();

    try {
        $result = AlibabaCloud::rpc()
                            ->product('Dysmsapi')
                            // ->scheme('https') // https | http
                            ->version('2017-05-25')
                            ->action('SendSms')
                            ->method('POST')
                            ->host('dysmsapi.aliyuncs.com')
                            ->options([
                                            'query' => [
                                            'RegionId' => "cn-hangzhou",
                                            'PhoneNumbers' => $mobile,
                                            'SignName' => "米米小院",
                                            'TemplateCode' => "SMS_185230293",
                                            'TemplateParam' => "{code:$code}",
                                            ],
                                        ])
                            ->request();
        return $result->toArray();
    } catch (ClientException $e) {
        return $e->getErrorMessage() . PHP_EOL;
    } catch (ServerException $e) {
        return $e->getErrorMessage() . PHP_EOL;
    }
}

//发送邮件
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
function sendEmail($email,$code)
{
    Mail::to($email)->send(new SendEmail($code));
}
//json
function ShowMsg($code,$msg){
    //设置json
    $arr=[
        "code"=>$code,
        "msg"=>$msg,
    ];
    echo json_encode($arr);
}