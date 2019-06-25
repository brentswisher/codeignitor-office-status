<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Office Status</title>
			
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="/officestatus/assets/css/bootstrap.custom.min.css" />

		<style>
			.navbar {
				border-radius: 0;
			}
			.req {
				color: #F00;
			}
			.container {
				width: 100%;
			}
			.table-striped th:last-child, .table-striped td:last-child {
				width: 1px;
				white-space: nowrap;
			}
		</style>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<meta http-equiv="refresh" content="300">
	</head>
	<body>
		<div class="navbar navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<!-- <cfIf sb.isLoggedIn> -->
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					<!-- </cfIf> -->
					<a class="navbar-brand" href="index.htm">
						Office Status
					</a>
				</div>
				<!-- <cfIf sb.isLoggedIn> -->
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="#">Welcome, <!-- <cfOutput>#session.user.fName# #session.user.lName#</cfOutput> --></a>
							</li>
							<li>
								<a href="/officestatus/logout"><span class="glyphicon glyphicon-lock"></span> logout</a>
							</li>
						</ul>
						<ul class="nav navbar-nav">
							<!-- <li <cfIf sb.routing[1] EQ "status">class="active"</cfIf>> -->
							<li>
								<a href="/officestatus/">Dashboard</a>
							</li>
							<!-- <li <cfIf sb.routing[1] EQ "employee">class="active"</cfIf>> -->
							<li>
								<a href="/officestatus/users">Employees </a>
							</li>
							<!-- <li <cfIf sb.routing[1] EQ "note">class="active"</cfIf>> -->
							<li>
								<a href="/officestatus/status">Status </a>
							</li>
						</ul>
					</div>
				<!-- </cfIf> -->
			</div>
		</div>
		<div class="container">
			<div class="content">