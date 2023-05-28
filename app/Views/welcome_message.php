<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Welcome to CodeIgniter 4!</title>
   <meta name="description" content="The small framework with powerful features">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" type="image/png" href="/favicon.ico">
</head>

<body>
   <h1>CodeIgniter4 Excel</h1>

   <h2>Import Excel</h2>
   <form action="import" method="post" enctype="multipart/form-data">
      <input type="file" name="excel_file">
      <button type="submit">Submit</button>
   </form>
   <h2>Export Excel</h2>
   <a href="export">Download</a>
</body>

</html>