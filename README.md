# tetris-website

----------------
Link to the VM
----------------

http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:54107/


------------
  Notes
------------

The way that the database works is that upon registration it will check if a username
or email already exists in the database, and if it exists, it will fail the registration
due to finding an identical existing user.
Although email wasn't in the specification, I wanted to add it as I felt it would be a nice
addition; however, I know that tests are being done via selenlium or by other means, so I have
allowed the email field to be empty (NULL) for ONE time only. This works because it will check 
the database and see if NULL already exists as an email. This is has been implemented on purpose. 
This is to facilitate simple direct queries outside of the HTML form. If you use the form, it will 
ask that you enter an email; but for the sake of compliance, I have set it to unrequired. But again,
due to the nature of the database checks, you cannot have more than one NULL email. Please take 
this into account.
Enjoy and welcome to Tetris.