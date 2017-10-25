<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add New Student Record | Laguna University - Clinic | Medical Records System</title>
<link rel="icon" href="../images/favicon.ico">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
<link href="../assets/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../assets/css/simple-sidebar.css" rel="stylesheet" type="text/css">
<link href="../assets/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
ul {
    list-style: none;
}
.dropdown-menu {
    width:200px;
}
.dropdown-menu>li>a.active, .dropdown-menu>li>a.active:focus {
    background-color:#666!important;
    color:white;
    border-left: 5px solid goldenrod;  

}
.dropdown-menu>li>a>i {
    float:right;
    line-height: 20px;
}
</style>
</head>
<body>

<div class="dropdown">
    <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">fauzi <span class="caret"></span>

    </button>
    <ul class="dropdown-menu" role="menu">
        <li role="presentation" class="have-child"> 
          <a role="menuitem" tabindex="-1" data-toggle="collapse" data-parent="#accordion" href="#profile">Profile Page <i class="glyphicon glyphicon-chevron-down"></i></a>
            <ul id="profile" class="panel-collapse collapse">
                <li><a href="profile">Visitor Message</a>

                </li>
                <li><a href="about-me">About Me</a>

                </li>
            </ul>
        </li>
        <li role="presentation" class="have-child"> 
          <a role="menuitem" tabindex="-1" data-toggle="collapse" data-parent="#accordion" href="#activities">Activities <i class="glyphicon glyphicon-chevron-down"></i></a>
            <ul id="activities" class="panel-collapse collapse">
                <li><a href="posts">All Post</a>

                </li>
                <li><a href="articles">All Article</a>

                </li>
            </ul>
        </li>
        <li role="presentation" class="have-child"> 
          <a role="menuitem" tabindex="-1" data-toggle="collapse" data-parent="#accordion" href="#pm">Private Message <i class="glyphicon glyphicon-chevron-down"></i></a>
            <ul id="pm" class="panel-collapse collapse">
                <li><a href="inbox">Inbox</a></li>
                <li><a href="outbox">Outbox</a></li>
            </ul>
        </li>
        <li role="presentation" class="divider"></li>
        <li role="presentation">
          <a role="menuitem" tabindex="-1" href="logout">Logout <i class="glyphicon glyphicon-log-out"></i></a>
        </li>
    </ul>
</div>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    $('ul[role="menu"]')
        .on('show.bs.collapse', function (e) {
        $(e.target).prev('a[role="menuitem"]').addClass('active');
    })
        .on('hide.bs.collapse', function (e) {
        $(e.target).prev('a[role="menuitem"]').removeClass('active');
    });

    $('a[data-toggle="collapse"]').click(function (event) {

        event.stopPropagation();
        event.preventDefault();

        var drop = $(this).closest(".dropdown");
        $(drop).addClass("open");

        $('.collapse.in').collapse('hide');
        var col_id = $(this).attr("href");
        $(col_id).collapse('toggle');

    });
});
</script>

</body>
</html>