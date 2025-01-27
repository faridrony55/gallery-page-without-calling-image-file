<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dynamic Image Gallery</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f4f9;


      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
      gap: 10px;
      padding: 20px;
      justify-items: center;
    }

    .gallery img {
      width: 100%;
      border-radius: 8px;
      transition: transform 0.5s ease;
      cursor: pointer;

    aspect-ratio: 1;
    object-fit: cover;
    }

    .gallery img:hover {
      transform: scale(1.05);
    }

     


       /* Modal Styles */
       .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.8);
      justify-content: center;
      align-items: center;
    }

    .modal img {
      max-width: 90%;
      max-height: 80%;
      border-radius: 8px;
      animation: zoomIn 0.3s ease;
    }

    .modal .close-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      font-size: 24px;
      color: white;
      background: transparent;
      border: none;
      cursor: pointer;
    }

    @keyframes zoomIn {
      from {
        transform: scale(0.8);
        opacity: 0;
      }
      to {
        transform: scale(1);
        opacity: 1;
      }
    }
  </style>
</head>
<body>




 
  <div class="gallery">

  <?php
    $folderPath = 'images'; 
    $images = array_diff(scandir($folderPath), array('.', '..'));
    $images = array_values($images);
    shuffle($images);
    foreach ($images as $image) {
        $filePath = $folderPath . '/' . $image;
        if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $image)) {
            echo "<img src='$filePath' alt='$image'>";
        }
    }
    ?>

 
  </div>
</body>
</html>



<div class="modal" id="photoModal">
    <button class="close-btn" id="closeBtn">&times;</button>
    <img src="" alt="Large View" id="modalImage">
  </div>

  <script>
    const galleryImages = document.querySelectorAll('.gallery img');
    const modal = document.getElementById('photoModal');
    const modalImage = document.getElementById('modalImage');
    const closeBtn = document.getElementById('closeBtn');

    galleryImages.forEach(img => {
      img.addEventListener('click', () => {
        modalImage.src = img.src;
        modal.style.display = 'flex';
      });
    });

    closeBtn.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    // Close modal when clicking outside the image
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  </script>
