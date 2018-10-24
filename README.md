# sse-csrf-2

This demonstrates how to prevent CSRF with double submit cookie. Here, a CSRF token is included in two places of a web form, one in the form itself and the other as a cookie. During validation, server side code verifies if the token in the cookie and the token in the form are a match. It's safe to process the information from the form if this is a match.

This demonstration has 3 files in it. The index.php file contains the login form and the validation code for the login. At login, it creates a CSRF token and sets a cookie from it.  The protected.php file is a contact form which is protected by the login. Upon loading the page, a javascript code extracts the CSRF token from the cookie string and adds it into the form.
