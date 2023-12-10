```html
# Horizon Students API

This repository contains the code for the Horizon Students API, a simple RESTful API designed to manage student information. The API provides endpoints to perform CRUD (Create, Read, Update, Delete) operations on a MySQL database table named `horizonstudents`. Below, you'll find information on how to use and configure the API.

## Installation and Configuration

1. **Clone the repository:**

   ```bash
   git clone https://github.com/your-username/horizon-students-api.git
   ```

2. **Configure the database connection:**

   Update the `.env` file with your database connection details:

   ```dotenv
   DB_HOST=your-database-host
   DB_NAME=your-database-name
   DB_USERNAME=your-database-username
   DB_PASSWORD=your-database-password
   ```

3. **Import the MySQL table:**

   Execute the SQL script `database.sql` in your MySQL database to create the `horizonstudents` table.

4. **Run the API:**

   ```bash
   php -S localhost:8000
   ```

## API Endpoints

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
GET http://localhost:8000/restful/horizonstudents?city=Badulla&province=Uva
```

### POST /restful/horizonstudents

Add a new student to the database.

- **Body:**
  - Provide a JSON object with student details.

#### Example

```http
POST http://localhost:8000/restful/horizonstudents
Content-Type: application/json

{
  "first_name": "John",
  "last_name": "Doe",
  "city": "Colombo",
  "district": "Colombo",
  "province": "Western",
  "email_address": "john.doe@example.com",
  "mobile_number": "1234567890"
}
```

### PUT /restful/horizonstudents

Update an existing student's information.

- **Body:**
  - Provide a JSON object with the student's updated details.
  - Include the `index_no` of the student to be updated.

#### Example

```http
PUT http://localhost:8000/restful/horizonstudents
Content-Type: application/json

{
  "index_no": 1,
  "city": "Kandy"
}
```

### DELETE /restful/horizonstudents

Delete a student from the database.

- **Body:**
  - Provide a JSON object with the `index_no` of the student to be deleted.

#### Example

```http
DELETE http://localhost:8000/restful/horizonstudents
Content-Type: application/json

{
  "index_no": 2
}
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
```