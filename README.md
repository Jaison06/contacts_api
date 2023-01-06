To get started:

Laravel 9 / php 8.2

Front end Vue3 Inertia

For Setup the Application

1. Import files this repository (https://github.com/Jaison06/contacts_api)
2. Rename `.env.example` to `.env`
3. Provide your database credentials in `.env` (`DB_CONNECTION`,`DB_HOST`,`DB_PORT`,`DB_DATABASE`,`DB_USERNAME`,`DB_PASSWORD`)
4. Run `composer install`
5. Run `php artisan key:generate`
6. Run `php artisan migrate`
7. Run `php artisan serve`
8. Run `npm install`
9. Run `npm run dev`

For Backend Api

1. Fisrt Need to register the website. http://127.0.0.1:8000/register (hostname depends on the server)
2. For api authentication 

End point :  http://127.0.0.1:8000/api/login (hostname depends on the server) , Method : POST
Headers : Accept : application/json
Request Body sample json : {"email":"example@gmail.com","password":"Example@2022"}. Here use your registered email and password.
Response shows  token. This token you can use for api authentication. sample  "token": "1|dm3FVayKJ99oZRomALpEuj49y71emSwaUXz2Y72y" 

** For every api call must use below Headers Key and Value **


** Accept : application/json and Authorization : Bearer 1|dm3FVayKJ99oZRomALpEuj49y71emSwaUXz2Y72y (use your token) **


Companies

1.Create Company
End Point http://127.0.0.1:8000/api/companies , Method : POST
sample request json {"company_name" : "example"}

2.List Companies
End Point http://127.0.0.1:8000/api/companies , Method : GET

2.List Companies with Pagination
End Point http://127.0.0.1:8000/api/companies?page=yes , Method : GET

3.Single Company
End Point http://127.0.0.1:8000/api/companies/{id} , Method : GET Here can put required company Id (Shows in CMS)

4.Update Company
End Point http://127.0.0.1:8000/api/companies/{id} , Method : PUT/PATCH Here can put required company Id (Shows in CMS)
sample request json {"company_name" : "example1"}


Contacts

1.Create Contact
End Point http://127.0.0.1:8000/api/contacts , Method : POST
sample request json {"company_id":"1","first_name":"example","last_name":"example","phone":"1234567890","email":"example@mail.com"} phone and email are unique for conatcs. phone accept 10 digits number

2.List Contacts
End Point http://127.0.0.1:8000/api/contacts , Method : GET

2.List Contacts with Pagination
End Point http://127.0.0.1:8000/api/contacts?page=yes , Method : GET

3.Single Contacts
End Point http://127.0.0.1:8000/api/contacts/{id} , Method : GET Here can put required contact Id (Shows in CMS)

4.Update Contact
End Point http://127.0.0.1:8000/api/contacts/{id} , Method : PUT/PATCH Here can put required contact Id (Shows in CMS)
sample request json {"company_id":"1","first_name":"example","last_name":"example","phone":"1234567890","email":"example@mail.com"}

4.Create contacts for same company
End Point http://127.0.0.1:8000/api/contacts/{id} , Method : POST Here can put required company Id (Shows in CMS). Please note here is company id
sample request json [{"first_name":"example1","last_name":"example2","phone":"4223424447","email":"example1@mail.com"},
{"first_name":"example2","last_name":"example2","phone":"4242452447","email":"example1@mail.com"}]

5.List of  Contacts given company
End Point http://127.0.0.1:8000/api/contacts/company/{id} , Method : GET Here can put required Company Id (Shows in CMS). Please note here is company id

6.Add notes for a contact
End Point http://127.0.0.1:8000/api/contacts/{id} , Method : PATCH Here can put required contact Id (Shows in CMS).
sample request json {"notes":"example notes"}

7.Search by contact name / company or email or notes
End Point http://127.0.0.1:8000/api/search/all , Method : POST
sample request json {"search":"example"}


Front End (login with your credentials)

Contacts listed with search filter http://127.0.0.1:8000/contacts

Companies listed with search filter http://127.0.0.1:8000/companies



End






