<!DOCTYPE html>
<html>
<head>
  <title>Detail Event</title>
  <style>
    body {
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .event-container {
      width: 80%; 
      height: 80%; 
      background-color: #fff;
      border-radius: 20px; 
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
      display: flex;
      flex-direction: column;
      padding: 20px; 
    }

    .event-image {
      width: 100%;
      height: 25%;
      object-fit: cover;
      border-radius: 16px; 
    }

    .event-details {
      margin-top: 20px; 
    }
  </style>
</head>
<body>
  <div class="event-container">
    <img src="path/ke/gambar/event.jpg" alt="Gambar Event" class="event-image">
    <div class="event-details">
      <h2>Judul Event</h2>
      <p>Deskripsi singkat tentang event.</p>
      </div>
  </div>
</body>
</html>