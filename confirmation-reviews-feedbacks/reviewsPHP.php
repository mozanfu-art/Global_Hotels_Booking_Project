<?php
include __DIR__.'/../db-connect.php';
session_start();


if (!isset($_SESSION['UserID'])) {
    header("Location: ../sign-home/Login-db.php");
    exit();
}

$sql = "SELECT full_name, review_text, Star_rate, created_at FROM hotel_reviews ORDER BY created_at DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['FullName'];
    $user_email = $_POST['userEmail'];
    $review_text = $_POST['reviewText'];
    $rating = $_POST['rating'];

    $stmt = $conn->prepare("INSERT INTO hotel_reviews (full_name, user_email, review_text, Star_rate, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssi", $full_name, $user_email, $review_text, $rating);
    $stmt->execute();
    $stmt->close();

    header("Location: reviewsPHP.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reviews</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            background-color: #004d40;
            color: #ffffff;
            padding: 15px 20px;
            position: relative;
            display: flex;
            align-items: center;
        }

        .header .home-link {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #ffffff;
            font-weight: bold;
            text-decoration: none;
        }

        .header h1 {
            flex-grow: 1;
            text-align: center;
            margin: 0;
            font-size: 1.8em;
        }

        /* Reviews Section */
        .section-reviews {
            padding: 2em;
            max-width: 1200px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .reviews-policy-button {
            margin-top: 2em;
            padding: 10px 20px;
            text-decoration: none;
            color: #004d40;
            border: 1px solid #004d40;
            font-size: 1.1em;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .reviews-policy-button:hover {
            background: #004d40;
            color: #fff;
        }

        /* Individual Review Styling */
        .review {
            background: #f9f9f9;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .review strong {
            color: #004d40;
            font-size: 1.2em;
        }

        .review p {
            font-size: 1em;
            color: #666;
        }

        .review small {
            display: block;
            margin-top: 10px;
            font-size: 0.9em;
            color: #999;
        }

        /* Review Form Styling */
        .review-form label {
            font-size: 1.1em;
            margin: 10px 0 5px;
            color: #004d40;
        }

        .review-form input, .review-form textarea, .review-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        .review-form textarea {
            resize: vertical;
            height: 150px;
        }

        .review-form button {
            padding: 10px 20px;
            background-color: #004d40;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .review-form button:hover {
            background-color: #00796b;
        }

        /* Footer Styles */
        footer {
            background-color: #004d40;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Your Reviews</h1>
    <a href="../sign-home/Home-(HB).html" class="home-link">Home</a>
</div>

<div class="section-reviews">
    <h2>Reviews</h2>

    <?php 
    if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()): ?>
            <div class="review">
                <strong><?php echo htmlspecialchars($row['full_name']); ?></strong> (<?php echo $row['Star_rate']; ?>/5)
                <p><?php echo htmlspecialchars($row['review_text']); ?></p>
                <small>Posted on <?php echo $row['created_at']; ?></small>
            </div>
        <?php endwhile; 
    else:
        echo "<p>No reviews found.</p>";
    endif;
    ?>

    <h3>Leave a Review</h3>
    <form method="POST" action="" class="review-form">
        <label for="FullName">Full Name:</label>
        <input type="text" name="FullName" required>

        <label for="userEmail">Email:</label>
        <input type="email" name="userEmail" required>

        <label for="reviewText">Review:</label>
        <textarea name="reviewText" required></textarea>

        <label for="rating">Rating:</label>
        <select name="rating" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <button type="submit">Submit Review</button>
    </form>

</div>

<footer>
    <p>&copy; 2025 Hotels Booking. All rights reserved.</p>
</footer>

</body>
</html>
