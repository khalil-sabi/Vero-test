<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Vero digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#imageModal">
            Open Image Modal
        </button></h1>

        <!-- Modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Upload Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Select an image</label>
                                <input class="form-control" type="file" id="imageInput" accept="image/*">
                            </div>
                        </form>
                        <div id="imagePreview" class="text-center">
                            <img id="previewImg" src="" class="img-fluid d-none">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->


        <h1 class="text-center mb-4">Tasks</h1>
        
        <input type="text" id="searchBar" class="form-control mb-3" placeholder="Search">
        
        <table id="taskTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Color Code</th>
                </tr>
            </thead>
            <tbody id="taskBody">
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/front.js"></script>
</body>
</html>
