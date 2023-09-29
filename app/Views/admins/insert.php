<!DOCTYPE html>
<html lang="en">
<head>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My products</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom CSS for background -->
    <style>
        /* Background color using Tailwind CSS classes */
        .bg-custom-khaki-silver {
            background: linear-gradient(to bottom, #F0E68C, #C0C0C0);
        }
    </style>
</head>
<body class="bg-custom-khaki-silver">

<!-- Include Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    // Your JavaScript code here
</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My products</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <br>
    <h1>Add New Product</h1>
    <form action="<?= base_url('create') ?>" method="post" enctype="multipart/form-data" onsubmit="return insertOrUpdateProduct()">
        <input type="hidden" id="productIndex" value="-1">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control">
        </div>
        <div class="form-group">
            <label for="image_url">Image</label>
            <input type="file" name="image_url" id="image_url" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="reviews">Reviews</label>
            <input type="number" name="reviews" id="reviews" class="form-control" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary" id="submitBtn">Add Product</button>
        <button type="button" class="btn btn-secondary" id="cancelBtn" onclick="cancelEdit()">Cancel</button>
    </form>
</div>
<div class="container mt-5">
    <h1>Table Product</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Contact</th>
            <th>Image</th>
            <th>Price</th>
            <th>Reviews</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="productTableBody">
        <!-- Products will be dynamically added here -->
        </tbody>
    </table>
</div>

<!-- Include Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
<script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    // Initialize an array to store product data
    let products = [];

    // Function to insert or update a product
    function insertOrUpdateProduct() {
        const name = document.getElementById("name").value;
        const description = document.getElementById("description").value;
        const image_url = document.getElementById("image_url").value;
        const price = parseFloat(document.getElementById("price").value);
        const reviews = parseInt(document.getElementById("reviews").value);
        const productIndex = parseInt(document.getElementById("productIndex").value);

        if (productIndex === -1) {
            // Insert a new product
            const product = { name, description, image_url, price, reviews };
            products.push(product);
        } else {
            // Update an existing product
            products[productIndex].name = name;
            products[productIndex].description = description;
            products[productIndex].image_url = image_url;
            products[productIndex].price = price;
            products[productIndex].reviews = reviews;
        }

        // Clear the form fields
        document.getElementById("name").value = "";
        document.getElementById("description").value = "";
        document.getElementById("image_url").value = "";
        document.getElementById("price").value = "";
        document.getElementById("reviews").value = "";

        // Change submit button text back to "Insert Product"
        document.getElementById("submitBtn").textContent = "Insert Product";

        // Update the product table
        updateProductTable();

        // Prevent the form from submitting
        return false;
    }

    // Function to populate the form fields for editing
    function editProduct(index) {
        document.getElementById("name").value = products[index].name;
        document.getElementById("description").value = products[index].description;
        document.getElementById("image_url").value = products[index].image_url;
        document.getElementById("price").value = products[index].price;
        document.getElementById("reviews").value = products[index].reviews;
        document.getElementById("productIndex").value = index;

        // Change submit button text to "Update Product"
        document.getElementById("submitBtn").textContent = "Update Product";
    }

    // Function to cancel editing and clear the form
    function cancelEdit() {
        document.getElementById("name").value = "";
        document.getElementById("description").value = "";
        document.getElementById("image_url").value = "";
        document.getElementById("price").value = "";
        document.getElementById("reviews").value = "";
        document.getElementById("productIndex").value = -1;

        // Change submit button text back to "Insert Product"
        document.getElementById("submitBtn").textContent = "Insert Product";
    }

    // Function to delete a product
    function deleteProduct(index) {
        if (confirm("Are you sure you want to delete this product?")) {
            // Remove the product from the array
            products.splice(index, 1);
            // Update the product table
            updateProductTable();
        }
    }

    // Function to update the product table
    function updateProductTable() {
        const tableBody = document.getElementById("productTableBody");
        tableBody.innerHTML = "";

        for (let i = 0; i < products.length; i++) {
            const product = products[i];
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${product.name}</td>
                <td>${product.description}</td>
                <td>${product.image_url}</td>
                <td>${product.price}</td>
                <td>${product.reviews}</td>
                <td>
                    <button class="btn btn-primary" onclick="editProduct(${i})">Edit</button>
                    <button class="btn btn-danger" onclick="deleteProduct(${i})">Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
        }
    }

    // Initial product table update
    updateProductTable();

</script>
</body>
</html>
