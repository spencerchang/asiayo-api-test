<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About AsiaYo API Test

使用最新版的 Laravel Framework 11.35.1

## SOLID 原則

-   SOLID 實踐法則: [l5-repository](https://github.com/andersao/l5-repository)
-   Concrete (服務組合)層: 協助 Controller 組合不同 Service 層的資料
-   Controller (控制器)層: 主控制器
-   Service (服務) 層: 業務邏輯
-   Repository (資源庫)層: 獲取屬於所屬 Model 不同條件下的資料
-   Entities (模型) 層: 資料表相關設定
-   Presenter (資料呈現預處理)層: 預處理介面資料呈現
-   View (資料呈現)層: 介面
-   PSR-2: Coding Style Guide [PHP Standards Recommendations](https://www.php-fig.org)

## 設計模式

-   訂單 id 不分國家爲唯一值，有訂單總表 order_infos
-   和各貨幣資料表
    -   order_twd_infos
    -   order_usd_infos
    -   order_jpy_infos
    -   order_rmb_infos
    -   order_myr_infos
-   設計總表的原因是便於分析 不分國家的訂單資料，且避免迴圈查詢不同國家資料表的情形
-   寫入時會使用 transaction 同步寫入訂單總表 order_infos 和所屬貨幣資料表
-   查詢時建議可設計藉由特定字樣如訂單號 TW00001 或帶國家代號 查詢所屬的貨幣資料表
-   如特定情況只能用訂單 id 查詢，可查詢訂單總表

## 安裝使用

運行以下命令：

-   安裝 composer 依賴

```bash
composer install
```

-   啟用 Docker
-

```bash
docker-compose up -d
```

-   執行 migrate

```bash
docker exec -it asiayo-laravel php artisan migrate
```

-   Endpoint

    POST

    ```bash
    http://localhost:8080/api/orders
    ```

    GET

    ```bash
    http://localhost:8080/api/orders/{id}
    ```
