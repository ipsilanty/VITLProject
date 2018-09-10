<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>VITL - Test Page</title>

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/node_modules/bootstrap/dist/css/bootstrap.min.css">

    <!-- App styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

    <!-- Vendors jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/node_modules/jquery/dist/jquery.min.js"></script>

    <!-- Google font (Lato) -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-y">
        <div class="container">
            <a class="navbar-brand" href="home">VITL Test</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse"></div>
        </div>
    </nav>
    <main class="main">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control" id="terms" name="terms" aria-describedby="User Name" placeholder="Enter name">
                        </div>
                        <div class="form-check form-group">
                            <input type="checkbox" class="form-check-input" id="dupes" name="dupes" checked />
                            <label class="form-check-label" for="exampleCheck1">Exclude duplicate entries</label>
                        </div>
                        <button type="button" class="btn btn-y" id="search"><i class="fas fa-search"></i> Search</button>
                    </div>
                    <div class="col-12" id="result-box"></div>
                </div>
            </div>
    </main>
    <script type="text/javascript">
        /* Get list of names by calling search method from Home controller through Ajax */
        $(document).on('click',"#search", function() {

            var terms = $("#terms").val(), dupes;
            if(terms != "" && terms.length > 2) { // check if the input value is valid
                dupes = ($('#dupes').is(":checked")) ? true : false;

                var data = [];
                data.push({name: 'terms', value: terms});
                data.push({name: 'dupes', value: dupes});

                $.ajax({
                    type: "POST",
                    url: "Home/search",
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.length > 0) { // if entries, display list of names
                            $( "#result-box").html("");
                            var items = [];
                            $.each( result, function( key, val ) {
                                items.push( "<li>" + val.name + "</li>" );
                            });

                            $( "<ol/>", {
                                "class": "my-new-list",
                                html: items.join( "" )
                            }).appendTo( "#result-box" );
                        } else { //if no entries, display a warning message
                            $( "#result-box").html("").html("<span id='empty-list' class='text-danger'><i class='fas fa-exclamation-circle'></i> No entries found!</span>");
                        }
                    }
                });
            } else {
                $( "#result-box").html("");
                alert("The name is too short. It should have 3 characters or more.");
            }

        });
    </script>
    <!-- Vendors -->
    <script src="<?php echo base_url(); ?>assets/vendors/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>