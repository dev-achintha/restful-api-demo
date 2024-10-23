# Horizon Students API

This repository contains the code for the Horizon Students API, a simple RESTful API designed to manage student information. The API provides endpoints to perform CRUD (Create, Read, Update, Delete) operations on a MySQL database table named `horizonstudents`. Below, you'll find information on how to use and configure the API.

## Online Testing

I have deployed this API online, and you can test it using 👉 [this link](https://soc-achinthas-projects.vercel.app/restful/horizonstudents)👈. You can use Postman or any API testing tool to interact with the API.

## Installation and Configuration

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/dev-achintha/restful-api-demo.git
   cd restful-api-demo
   ```

2. **Set Up Environment Variables:**
   Create a `.env` file in the `config` directory and set the following environment variables:
   ```env
   DB_HOST=your_database_host
   DB_NAME=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

3. **Install Dependencies:**
   ```bash
   composer install
   ```

4. **Run the API:**
   Start a local development server:
   ```bash
   php -S localhost:8000
   ```
   The API will be accessible at `http://localhost:8000`.

## Features

- **GET /restful/horizonstudents:** Retrieve a list of all students or filter based on specific parameters.
- **POST /restful/horizonstudents:** Add a new student to the database.
- **PUT /restful/horizonstudents:** Update an existing student's information.
- **DELETE /restful/horizonstudents:** Delete a student from the database.

## Use Cases with Postman

### GET /restful/horizonstudents

Retrieve a list of students. You can optionally provide parameters to filter the results.

- **Parameters:**
  - `index_no`: Filter by student index number.
  - `first_name`: Filter by student first name.
  - `last_name`: Filter by student last name.
  - `city`: Filter by city.
  - `district`: Filter by district.
  - `province`: Filter by province.
  - `email_address`: Filter by email address.
  - `mobile_number`: Filter by mobile number.

#### Example

```http
GET https://soc-achinthas-projects.vercel.app/restful/horizonstudents?city=Colombo&province=Western
```

### POST /restful/horizonstudents

Add a new student to the database.

- **Body:**
  - Provide a JSON object with student details.

#### Example

```http
POST https://soc-achinthas-projects.vercel.app/restful/horizonstudents
Content-Type: application/json

{
  "first_name": "Kavindu",
  "last_name": "Perera",
  "city": "Colombo",
  "district": "Colombo",
  "province": "Western",
  "email_address": "kavindu.perera@gmail.com",
  "mobile_number": "0771234567"
}
```

### PUT /restful/horizonstudents

Update an existing student's information.

- **Body:**
  - Provide a JSON object with the student's updated details.
  - Include the `index_no` of the student to be updated.

#### Example

```http
PUT https://soc-achinthas-projects.vercel.app/restful/horizonstudents
Content-Type: application/json

{
  "index_no": 3,
  "city": "Matara"
}
```

### DELETE /restful/horizonstudents

Delete a student from the database.

- **Body:**
  - Provide a JSON object with the `index_no` of the student to be deleted.

#### Example

```http
DELETE https://soc-achinthas-projects.vercel.app/restful/horizonstudents
Content-Type: application/json

{
  "index_no": 5
}
```
