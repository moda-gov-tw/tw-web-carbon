# 政府資料開放平臺前端

[![image](https://img.shields.io/github/license/Naereen/StrapDown.js.svg)](https://opensource.org/licenses/MIT) [![image](https://img.shields.io/badge/node.js-v18.x-green.svg)](https://nodejs.org/en) [![image](https://img.shields.io/badge/Vue-3.x-green.svg)](https://vuejs.org/) 

## 簡介

本專案為[政府資料開放平臺](https://data.gov.tw)前端開源，透過開源程式提供政府機關或民間團體，共同為政府開放資料盡一份心力。

本平臺採用 [Vue.js](https://vuejs.org/) 框架開發，使用了 [Laravel](https://laravel.com/) 框架進行後端的開發，並以 [bootstrap](https://getbootstrap.com/) 作為UI框架，另外，也通過了無障礙網路空間服務網的 (Accessibility) 的 Freego 測試。

## 開發環境&安裝

本專案開發環境和本專案主要有用到的套件如下：

- [Node.js](https://nodejs.org/en/) v18.0.0 以上
- [Laravel](https://laravel.com/) v10
- [bootstrap](https://getbootstrap.com/)

建議使用 vscode 作為開發工具，並能安裝 vue 相關套件來做輔助。

### 環境安裝

-  安裝NodeJS

    1. https://raw.githubusercontent.com/creationix/nvm/v0.39.1/install.sh | bash

    1. Command 輸入已下指令
        
        nvm install 18.20.3 //安裝18.20.3版本
       
        nvm use 18.20.3 //指定18.20.3版本

-  安裝PHP
    
    1. 下載PHP 8.2 ZTS最新版本
    
    1. 解壓縮檔案

    1. 修正php.ini內容

        ```properties
        max_execution_time = 300
        memory_limit = -1
        post_max_size = 1G

        #取消註解
        extension_dir = "ext"

        upload_max_filesize = 1G
        max_file_uploads = 100

        #取消註解以下extension
        curl
        gd
        mbstring
        openssl

        #加入extension
        extension=php_redis.dll`

        #修正參數內容
        date.timezone = Asia/Taipei

        `php -v`

-  安裝 Composer

    1. 下載並安裝

-  安裝 Mysql


    ``` sql
    CREATE USER 'USERS'@'localhost' IDENTIFIED BY 密碼;
    ```
    4. #### 指定匯入匯出資料夾路徑並給予權限
    ``` sql
    #給予權限
    GRANT ALL PRIVILEGES ON *.* TO 'web'@'localhost';
    ```

- 安裝Nginx

    1. 下載Nginx

    1. 修改sites-available/wppms-develop檔案      
        
    1. 啟動Nginx Service

        `sudo service nginx restart`

## 程式安裝/更新
1. 更新.env，使其符合自身環境
1. 更新Composer Package，於資料夾下輸入command

    `composer install`

1. 更新node_modules，於資料夾下輸入command

    `npm install`

    `npm run build`


## License

本專案使用了 [MIT](https://github.com/moda-gov-tw) License


## 備註

本專案為政府資料開放平臺前端開源示範案例，議題(Issues)處理範圍為程式錯誤(Bug)，版本更新則以系統改版等重大變更為主。
