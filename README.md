# web_api

### 1. 项目介绍  
该项目是一个服务器端api的框架，采用 __nginx__+__php-fpm__+__php5.6__ 的方案，数据库为 __mysql5.6__+__redis__ ，使用的框架是 __phalcon__ ，这是一个使用 __C__ 扩展编写的高性能php框架。服务器端操作系统为 centos7。  
phalcon文档：[https://phalconphp.com/zh/](https://phalconphp.com/zh/)  

### 2. nginx安装及配置  
##### 安装nginx:  
这里为了方便直接只用了yum安装:  

`yum install -y nginx`  

若无包括nginx的库可使用:  

`rpm -Uvh http://nginx.org/packages/centos/7/noarch/RPMS/nginx-release-centos-7-0.el7.ngx.noarch.rpm`  

添加nginx的依赖库到yum的源  

安装完成后，可使用`service nginx start`或`systemctl start nginx.service`启动nginx服务  

* 若想使 _nginx_ 支持 _https_ 协议，还需安装 __openssl__  
* 若想使 _nginx_ 开机启动，可以使用命令`systemctl enable nginx.service`  
* 若想使 _nginx_ 安装在指定的文件夹，可自行下载编译安装，方法就请自行搜索吧，也很简单。

##### 配置nginx:  
这里简单的修改了下 __nginx.conf__ 文件中的server配置:
```nginx
server {
    listen       80;
    server_name  127.0.0.1;
    set $root_path '项目路径--替换';

    root   $root_path;
    index  index.php index.html index.htm;

    try_files $uri $uri/ @rewrite;

    location @rewrite {
        rewrite ^/(.*)$ /index.php?_url=/$1 last;
    }

    location ~ \.php$ {
        try_files $uri = 404;
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }

    location ~* ^/(css|img|images|js|flv|swf|download|gzs)/(.+)$ {
        root $root_path;
    }
}
```
配置完成后可以使用`service nginx restart`或`service nginx reload`重新启动 _nginx_  
### 3.mysql安装  
= =下次写
