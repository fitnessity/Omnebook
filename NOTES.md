### How to load ./fitnessity_dev.sql into the laravel database

```bash
fitnessity-db-1   | 2024-07-08T17:38:37.911293Z 0 [Note] InnoDB: FTS optimize thread exiting.
fitnessity-db-1   | 2024-07-08T17:38:37.911408Z 0 [Note] InnoDB: Starting shutdown...
fitnessity-db-1   | 2024-07-08T17:38:38.011579Z 0 [Note] InnoDB: Dumping buffer pool(s) to /var/lib/mysql/ib_buffer_pool
fitnessity-db-1   | 2024-07-08T17:38:38.012206Z 0 [Note] InnoDB: Buffer pool(s) dump completed at 240708 17:38:38
fitnessity-db-1   | 2024-07-08T17:38:39.027501Z 0 [Note] InnoDB: Shutdown completed; log sequence number 12219281
fitnessity-db-1   | 2024-07-08T17:38:39.031678Z 0 [Note] InnoDB: Removed temporary tablespace data file: "ibtmp1"
fitnessity-db-1   | 2024-07-08T17:38:39.031692Z 0 [Note] Shutting down plugin 'MEMORY'
fitnessity-db-1   | 2024-07-08T17:38:39.031697Z 0 [Note] Shutting down plugin 'CSV'
fitnessity-db-1   | 2024-07-08T17:38:39.031702Z 0 [Note] Shutting down plugin 'sha256_password'
fitnessity-db-1   | 2024-07-08T17:38:39.031705Z 0 [Note] Shutting down plugin 'mysql_native_password'
fitnessity-db-1   | 2024-07-08T17:38:39.031845Z 0 [Note] Shutting down plugin 'binlog'
fitnessity-db-1   | 2024-07-08T17:38:39.035492Z 0 [Note] mysqld: Shutdown complete
fitnessity-db-1   |
fitnessity-db-1 exited with code 0
e4d25d2653a9_fitnessity-db-1 exited with code 0
fitnessity-app-1              | [Mon Jul 08 17:38:39.491028 2024] [mpm_prefork:notice] [pid 1] AH00170: caught SIGWINCH, shutting down gracefully
fitnessity-app-1 exited with code 0
(base) ➜  fitnessity git:(experimental-docker) ✗ docker ps
CONTAINER ID   IMAGE            COMMAND                  CREATED          STATUS          PORTS                                                  NAMES
3590696699ee   fitnessity-app   "docker-php-entrypoi…"   18 seconds ago   Up 15 seconds   0.0.0.0:8000->80/tcp, :::8000->80/tcp                  fitnessity-app-1
06d47da68ed3   mysql:5.7        "docker-entrypoint.s…"   18 seconds ago   Up 15 seconds   0.0.0.0:3306->3306/tcp, :::3306->3306/tcp, 33060/tcp   fitnessity-db-1
c16f7a9a48a1   redis:latest     "docker-entrypoint.s…"   7 days ago       Up 6 days       0.0.0.0:6379->6379/tcp, :::6379->6379/tcp              redis-redis-1
(base) ➜  fitnessity git:(experimental-docker) ✗ docker exec -it 359069 /bin/bash
root@3590696699ee:/var/www/html# mysql
ERROR 2002 (HY000): Can't connect to local MySQL server through socket '/run/mysqld/mysqld.sock' (2)
root@3590696699ee:/var/www/html# mysql -h db -u root -p your_mysql_root_password
Enter password:
ERROR 1049 (42000): Unknown database 'your_mysql_root_password'
root@3590696699ee:/var/www/html# mysql -h db -u root
ERROR 1045 (28000): Access denied for user 'root'@'172.23.0.3' (using password: NO)
root@3590696699ee:/var/www/html# mysql -h db -u root -p
Enter password:
Welcome to the MariaDB monitor.  Commands end with ; or \g.
Your MySQL connection id is 4
Server version: 5.7.44 MySQL Community Server (GPL)

Copyright (c) 2000, 2018, Oracle, MariaDB Corporation Ab and others.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

MySQL [(none)]> show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| laravel            |
| mysql              |
| performance_schema |
| sys                |
+--------------------+
5 rows in set (0.004 sec)

MySQL [(none)]> use laravel;
Database changed
MySQL [laravel]> show tables;
Empty set (0.000 sec)

MySQL [laravel]>
[1]+  Stopped                 mysql -h db -u root -p
root@3590696699ee:/var/www/html# mysql -h db -u laraveluser -pyour_laravel_db_password laravel <
.dockerignore                 .htpasswd                     composer.lock                 license.txt                   sitemap.xml
.editorconfig                 .styleci.yml                  config/                       package-lock.json             storage/
.env                          ==vender.zip                  create-checkout-session.php   package.json                  stripe/
.env.example                  Dockerfile                    create-checkout-session2.php  php.ini-production            test.php
.ftpquota                     README.md                     database/                     phpunit.xml                   tests/
.git/                         api.php                       dbdata/                       public/                       vender.zip
.gitattributes                app/                          docker-compose.yml            readme.html                   vendor/
.gitignore                    artisan                       fitnessity_dev.sql            resources/                    webpack.mix.js
.htaccess                     bootstrap/                    geoff.php                     routes/
.htaccess-bak2                composer.json                 index.php                     ruby_test/
root@3590696699ee:/var/www/html# mysql -h db -u laraveluser -pyour_laravel_db_password laravel < fitnessity_dev.sql
root@3590696699ee:/var/www/html# fg
mysql -h db -u root -p
MySQL [laravel]> show tables;
+----------------------------------------+
| Tables_in_laravel                      |
+----------------------------------------+
| ===Products                            |
| ==fees                                 |
| Orders                                 |
| activity_Get_Started_Fast              |
| activity_cancel                        |
| activity_slider                        |
| add_on_service                         |
| addr_cities                            |
| addr_countries                         |
| addr_states                            |
| admin                                  |
| announcement                           |
| announcement_category                  |
| announcement_contact_customer_list     |
| announcement_contact_list              |
| background_check_faq                   |
| background_check_vatted_business_faq   |
| bookactivity                           |
| booking_activity_cancel                |
| booking_checkin_details                |
| booking_postorders                     |
| braintree_cart                         |
| braintree_orders                       |
| braintree_products                     |
| braintree_users                        |
| busi_page_favourite                    |
| busi_page_followers                    |
| business_activity_scheduler            |
| business_checkin_settings              |
| business_claims                        |
| business_class_price_option            |
| business_companydetail                 |
| business_customer_upload_files         |
| business_experience                    |
| business_informations                  |
| business_positions                     |
| business_post_views                    |
| business_price_details                 |
| business_price_details_ages            |
| business_review                        |
| business_service                       |
| business_service_review                |
| business_services                      |
| business_services_faq                  |
| business_services_favorite             |
| business_services_map                  |
| business_staff                         |
| business_subscription_plan             |
| business_terms                         |
| business_verified                      |
| calendar                               |
| cart                                   |
| chk_attendance                         |
| ci_sessions                            |
| cms                                    |
| company_informations                   |
| company_revenue_goal_tracker           |
| contact_us                             |
| custom_client_list                     |
| custom_list                            |
| customer_documents_requested           |
| customer_notes                         |
| customer_plan_details                  |
| customers                              |
| customers_1                            |
| customers_documents                    |
| customers_family_details               |
| discover                               |
| event_booking                          |
| excel_upload_tracker                   |
| failed_jobs                            |
| features                               |
| fit_carts                              |
| fit_help                               |
| fitnessity_admin                       |
| fitnessity_content                     |
| fitnessity_feedbacks                   |
| getstarted                             |
| gifted_activity_details                |
| home_tracker                           |
| inquiry_box                            |
| instant_forms                          |
| jobpostbidding                         |
| jobpostquestions                       |
| jobposts                               |
| jobs                                   |
| languages                              |
| login_attempts                         |
| meetings                               |
| membership_plans                       |
| migrations                             |
| miscellaneous                          |
| newsletters                            |
| notification                           |
| on_board_questions                     |
| online                                 |
| page_attachment                        |
| page_like                              |
| page_post_likes                        |
| page_post_save                         |
| page_postcomments                      |
| page_postcomments_like                 |
| page_posts                             |
| password_resets                        |
| person                                 |
| post_comments                          |
| post_comments_like                     |
| post_likes                             |
| post_reports                           |
| product_brands                         |
| product_colors                         |
| product_material                       |
| product_size                           |
| products                               |
| products_category                      |
| products_fitness                       |
| professional_type                      |
| profile_favs                           |
| profile_followers                      |
| profile_post_views                     |
| profile_posts                          |
| profile_saves                          |
| profile_views                          |
| promo_codes                            |
| recurring                              |
| reviews                                |
| slider                                 |
| social_accounts                        |
| sports                                 |
| sports_categories                      |
| stripe_payment_methods                 |
| tbl_payment                            |
| timeline_feeds                         |
| timeline_feeds_comments                |
| timeline_feeds_likes                   |
| timeline_feeds_media                   |
| timeline_feeds_report                  |
| timeline_feeds_share                   |
| trainer                                |
| transaction                            |
| user_autologin                         |
| user_booking_details                   |
| user_booking_quotes                    |
| user_booking_recurring_payment_details |
| user_booking_status                    |
| user_certifications                    |
| user_customer_details                  |
| user_educations                        |
| user_employment_histories              |
| user_evident                           |
| user_family_details                    |
| user_follower                          |
| user_memberships                       |
| user_networks                          |
| user_professional_details              |
| user_profiles                          |
| user_security_questions                |
| user_services                          |
| user_skill_awards                      |
| users                                  |
| users_add_attachment                   |
| users_favourite                        |
| users_follow                           |
| users_follow_temp                      |
| users_payment_info                     |
| vender                                 |
| vetted_business_faq                    |
| zip_codes                              |
+----------------------------------------+
168 rows in set (0.001 sec)

MySQL [laravel]>

```
