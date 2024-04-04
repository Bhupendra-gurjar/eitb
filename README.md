Hi I have attached assignment code and it's database file 
How to setup :

1. Please Create a clone from *main* branch or using this link 'https://github.com/Bhupendra-gurjar/eitb.git'.

2. I have attached a sql file named **ec2usernew.sql** . Please import this db to your db.
3. Then open our site browser and login using below **credentials**
   Username: admin
   Password: admin 
4. After login check i have created a three Content type and three paragraph
5. there are 3 pages which is created using 3 diffrent content type.</br> 
   __This is URL for nodes__:  </br>  your_base_url/node/2 </br> 
                           your_base_url/node/3</br> 
                           your_base_url/node/4</br> 
   
7. If you want to test a rest api of this content types
   So this are the 3 endpoints : For getting
  </br>  __Basic page Content type node data__: your_base_url/basic_page/node
   </br>  __Blog Content type node data__: your_base_url/blog/node
   </br>  __Article Content type node data__:  your_base_url/article/node

   Use Get method for retriving data and keep Basic Auth in authorization
   this is credentials for __basic_auth__ : Username: admin
                                        Password: admin
 
 **Notes**: Example of your_base_url will be like 'http://ec2user.net/node/4' or 'localhost/ec2user/web/node/4'
