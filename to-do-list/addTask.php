<!DOCTYPE html>
<html>
   <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/7e8022a4f3.js" crossorigin="anonymous"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp"
      crossorigin="anonymous"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="stylesheet.css">
   </head>
   <body>
    <div class="main-body">
    <section class="container py-5">
        <div class="w-50 mx-auto">
        <form action="#" method="GET" class="form-design px-5">
            <h2 class="pt-4">Add a Task</h2>
            <div class="form-row pb-5">
                <div class="form-group mt-3">
                    <label for="taskName">Task Name</label>
                    <input type="text" class="form-control" id="taskName" placeholder="Enter the name for your task..." data-sb-validations="required" />   
                </div>

                <div class="form-group mt-3">
                    <label for="taskDecrip">Task Description</label>
                    <input type="text" class="form-control" id="taskDescrip" placeholder="Enter the description of ypur task..." data-sb-validations="required" />
                </div>

                <div class="form-group mt-3">
                    <label for="dueDate">DueDate</label>
                    <input type="date" class="form-control" id="dueDate" placeholder="yyyy/mm/dd" data-sb-validations="required" />
                </div>

                <div class="form-group mt-3">
                    <label for="duetime">Time</label>
                    <input type="time" class="form-control" id="duetime" placeholder="00:00" data-sb-validations="required" />
                </div>

                
                <div class="form-group mt-3">
                <input type="submit" value="Submit" class="btn button-style">
                <input type="reset" class="btn button-style">
                </div>
            </div>
            
        </form>
        </div>
    </section>
    </div>



   </body>
</html>