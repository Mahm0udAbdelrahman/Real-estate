@extends('admin.layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Improved Form</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
            }

            .form-container {
                max-width: 500px;
                margin: 50px auto;
                background-color: #fff;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .form-container label {
                font-weight: bold;
            }

            .form-container button[type="submit"] {
                background-color: #007bff;
                color: #fff;
                border: none;
                cursor: pointer;
                padding: 12px;
                border-radius: 5px;
                font-size: 16px;
                transition: background-color 0.3s ease;
                width: 100%;
            }

            .form-container button[type="submit"]:hover {
                background-color: #0056b3;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="form-container">
                <form id="accountForm">
                    <div class="form-group" id="personForm">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>

                        <label for="first-name">First Name</label>
                        <input type="text" class="form-control" id="first-name" name="first-name" required>

                        <label for="last-name">Last Name</label>
                        <input type="text" class="form-control" id="last-name" name="last-name" required>

                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>

                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required>

                        <label for="profile-photo">Profile Photo</label>
                        <input type="file" class="form-control-file" id="profile-photo" name="profile-photo">
                    </div>

                    <div class="form-group" id="companyForm" style="display:none;">
                        <label for="company-email">Email</label>
                        <input type="email" class="form-control" id="company-email" name="company-email" required>

                        <label for="company-name">Company Name</label>
                        <input type="text" class="form-control" id="company-name" name="company-name">

                        <label for="number-of-employees">Number Of Employees</label>
                        <input type="text" class="form-control" id="number-of-employees" name="number-of-employees">

                        <label for="company-location">Location</label>
                        <input type="text" class="form-control" id="company-location" name="company-location">

                        <label for="company-bio">Bio</label>
                        <textarea class="form-control" id="company-bio" name="company-bio"></textarea>

                        <label for="company-profile-photo">Company Profile Photo</label>
                        <input type="file" class="form-control-file" id="company-profile-photo"
                            name="company-profile-photo">
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="person-radio" name="account-type" class="custom-control-input"
                                value="person" checked>
                            <label class="custom-control-label" for="person-radio">Person</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="company-radio" name="account-type" class="custom-control-input"
                                value="company">
                            <label class="custom-control-label" for="company-radio">Company</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Confirm</button>

                    <p class="text-center mt-3">Already have an account? <a href="#" class="text-primary">Login
                            now</a></p>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var personForm = document.getElementById('personForm');
                var companyForm = document.getElementById('companyForm');
                var accountTypeRadios = document.querySelectorAll('input[name="account-type"]');

                function toggleForm() {
                    if (document.getElementById('person-radio').checked) {
                        personForm.style.display = 'block';
                        companyForm.style.display = 'none';
                    } else if (document.getElementById('company-radio').checked) {
                        personForm.style.display = 'none';
                        companyForm.style.display = 'block';
                    }
                }

                accountTypeRadios.forEach(function(radio) {
                    radio.addEventListener('change', toggleForm);
                });

                toggleForm(); // Initial state
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
@endsection
