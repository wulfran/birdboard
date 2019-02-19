<html>
<head>
    <title>BirdBoard</title>
</head>
<body>
    <h1>Birdboard - create a project</h1>
    <form action="{{ route('projects.save') }}" method="POST">
        {{ csrf_field() }}
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input class="form-control" type="text" name="title" id="title">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-controll">
                        <textarea name="description" id="description" cols="30" rows="10" class="form-group"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <input type="submit" class="btn btn-primary btn-md" value="Submit">
                </div>
            </div>
        </div>
    </form>
</body>
</html>