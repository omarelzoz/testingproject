<?php
session_start();
if (isset($_SESSION['farmer_name'])) {
    include 'afterlogin.php';
    

    
    // Check if the user is an admin
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
        // Include admin page
        include 'admin.php'; // Create this file for your admin dashboard
    }
} else {
    include 'beforelogin.php';
}
?>










<style>
   .card {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px; /* Space between rows */
    }
    .card img {
      height: 200px;
      object-fit: cover;
    }
    h1{
      color: #1A553B;
    }
    h4{
      color: #1A553B;
    }
    h5{
      color: #1A553B;
    }


    
    .card-body p{
      color: #1A553B;
    }

</style>








  







<div class="title" style="text-align: center;color:#1A553B;" >
    <h1>Smart Agriculture Monitoring Automation System</h1>
    <h3>This Web aims to develop a comprehensive AI-powered system for precision agriculture, specifically focusing on tomato crops. The system will encompass crop disease detection, pest identification, irrigation scheduling, and automation with smart water valves. The system will leverage a variety of data sources and will integrate web interfaces for ease of use by farmers.
<hr>
       
       


</div>



<div style="margin-left: 20px;">
<h1>Care Guide</h1>
   <P><h4>useful guidelines and tips</h4>  </P>
   </div>
<div class="container my-5">
  <div class="row g-4">
    <!-- Card 1 -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card">
        <img src="images/sec1 1.jpeg" class="card-img-top" alt="Image 1">
        <div class="card-body" style="height:150px ;">
          <h5 class="card-title">Sunlight</h5>
          <p class="card-text">Plants need sunlight to turn into energy. The right amount is important.</p>
        </div>
      </div>
    </div>
    <!-- Card 2 -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card">
        <img src="images/sec1 2.jpeg" class="card-img-top" alt="Image 2">
        <div class="card-body"style="height:150px ;">
          <h5 class="card-title">Watering</h5>
          <p class="card-text">The best way to tell if your houseplant needs watering is to monitor the soil.</p>
        </div>
      </div>
    </div>
    <!-- Card 3 -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card">
        <img src="images/sec1 3.jpeg" class="card-img-top" alt="Image 3">
        <div class="card-body"style="height:150px ;">
          <h5 class="card-title">Rain Water</h5>
          <p class="card-text">If you can, it is a good idea to use rain water for your houseplants.</p>
        </div>
      </div>
    </div>
    <!-- Card 4 -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card">
        <img src="images/sec1 4.jpeg" class="card-img-top" alt="Image 4">
        <div class="card-body"style="height:150px ;">
          <h5 class="card-title">Fresh Air</h5>
          <p class="card-text">Open windows near your houseplants so they can breathe in fresh air.</p>
        </div>
      </div>
    </div>
  </div>
</div>











<div style="margin-left: 20px;">
<h1>Did you know?</h1>
   <P><h4>Facts about tomatoes</h4>  </P>
   </div>
<div class="container my-5">
  <div class="row g-4">
    <!-- Card 1 -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card">
        <img src="images/sec2 1.jpeg" class="card-img-top" alt="Image 1">
        <div class="card-body" style="height:200px ;">
          <h5 class="card-title">Choose your tomatoes</h5>
          <p class="card-text">Good starter plants are short and stocky with dark green color and straight, they should not have yellowing leaves or spots.</p>
        </div>
      </div>
    </div>
    <!-- Card 2 -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card">
        <img src="images/sec2 2.jpeg" class="card-img-top" alt="Image 2">
        <div class="card-body"style="height:200px ;">
          <h5 class="card-title">When to plant tomatoes</h5>
          <p class="card-text">Tomatoes are long-season, heat-loving plants that won’t tolerate frost, so wait until the weather has warmed up in the spring.</p>
        </div>
      </div>
    </div>
    <!-- Card 3 -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card">
        <img src="images/sec2 3.jpeg" class="card-img-top" alt="Image 3">
        <div class="card-body"style="height:200px ;">
          <h5 class="card-title">Site with sun</h5>
          <p class="card-text">Select a site with full sun! In northern regions, 8 to 10 hours of direct sunlight are preferred. In southern regions, light afternoon shade will help tomatoes to survive.</p>
        </div>
      </div>
    </div>
    <!-- Card 4 -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card">
        <img src="images/sec2 4.jpeg" class="card-img-top" alt="Image 4">
        <div class="card-body" style="height:200px ;">
          <h5 class="card-title">Watering</h5>
          <p class="card-text">Water in the early morning, water generously the first few days, Then, water with about 2 inches (about 1.2 gallons) per square foot per week during the growing season.</p>
        </div>
      </div>
    </div>
  </div>
</div>










<div style="margin-left: 20px;">
<h1>Diseases</h1>
   <P><h4>Some Diseases</h4>  </P>
   </div>
<div class="container my-5">
  <div class="row g-4">
    <!-- Card 1 -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card">
        <img src="images/sec3 1.jpeg" class="card-img-top" alt="Image 1">
        <div class="card-body">
          <h5 class="card-title">Tomato Bacterial spot</h5>
          
        </div>
      </div>
    </div>
    <!-- Card 2 -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card">
        <img src="images/sec3 2.jpeg" class="card-img-top" alt="Image 2">
        <div class="card-body">
          <h5 class="card-title">Tomato Septoria leaf</h5>
         
        </div>
      </div>
    </div>
    <!-- Card 3 -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card">
        <img src="images/sec3 3.jpeg" class="card-img-top" alt="Image 3">
        <div class="card-body">
          <h5 class="card-title">Early Blight</h5>
          
        </div>
      </div>
    </div>
    <!-- Card 4 -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card">
        <img src="images/sec3 4.jpeg" class="card-img-top" alt="Image 4">
        <div class="card-body">
          <h5 class="card-title">Late Blight</h5>
          
        </div>
      </div>
    </div>
  </div>
</div>




<!-- Content Section
<div class="containersection">
    <div class="content-section">
        <h1>Guide</h1>
        <img src="images/tomatoes 1.jpg" alt="Small Image">
        <p>
            <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              Read more
            </a>
          </p>
          <div class="collapse" id="collapseExample">
            <div class="card card-body" style="color:#1A553B;">
              <h4>  1. Choosing the Right Location
                Select a spot that receives direct sunlight for 6-8 hours a day, as tomatoes need sun to grow healthily and produce good fruit.</h4> <br>
                <h4>  2. Soil Preparation
                The soil should be fertile and rich in organic matter. Mix in compost or organic fertilizer before planting to ensure sufficient nutrients.
                Ensure the soil has good drainage to prevent water accumulation, which can lead to root rot.</h4> <br>
                <h4> 3. Planting Seedlings or Seeds
                Tomatoes can be grown from seedlings or seeds. If planting from seeds, start indoors 6-8 weeks before the outdoor planting date.
                When transplanting seedlings, plant them deep so that the lower leaves are under the soil, which encourages strong root growth.</h4><br>
                <h4> 4. Regular Watering
                Tomatoes need consistent watering, especially during the growing period. Keep the soil moist but avoid waterlogging. Even watering helps prevent fruit cracking.
                Try to water the soil directly rather than the leaves to reduce the risk of fungal diseases.</h4><br>
                <h4> 5. Periodic Fertilization
                Use a fertilizer rich in potassium and phosphorus, essential for flowering and fruit formation. Apply fertilizer every 2-3 weeks depending on the type used.</h4><br>
                <h4>6. Pruning and Training
                Prune the lower leaves and side shoots that may hinder air circulation and increase disease risk. This helps direct the plant's energy toward fruit production.
                Use stakes or cages to support the plant and prevent stems from breaking under the weight of the fruit.</h4><br>
                <h4>7. Pest and Disease Prevention
                Regularly inspect plants for any signs of pests like spider mites and aphids, or diseases like powdery mildew or bacterial spots.
                Use organic or natural pesticides, such as neem oil or soap solution, if you notice any infestation to maintain plant health.</h4><br>
                <h4> 8. Harvesting
                Harvest tomatoes when they turn red or the color specific to the variety being grown. They can be picked at partial ripeness and allowed to ripen at room temperature.
                Be gentle when picking to avoid damaging the fruit or stems.</h4><br>
            </div>
            
          </div>
   
        </div>
        
        
</div>


<div class="containersection">
    <div class="content-section">
        <h1>How does it work.</h1>
        <img src="images/tomatoes 1.jpg" alt="Small Image">
        <p>
            <a class="btn btn-success" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
              Read more
            </a>
          </p>
          <div class="collapse" id="collapseExample2">
            <div class="card card-body" style="color:#1A553B;">
              <h4>  1. Choosing the Right Location
                Select a spot that receives direct sunlight for 6-8 hours a day, as tomatoes need sun to grow healthily and produce good fruit.</h4> <br>
                <h4>  2. Soil Preparation
                The soil should be fertile and rich in organic matter. Mix in compost or organic fertilizer before planting to ensure sufficient nutrients.
                Ensure the soil has good drainage to prevent water accumulation, which can lead to root rot.</h4> <br>
                <h4> 3. Planting Seedlings or Seeds
                Tomatoes can be grown from seedlings or seeds. If planting from seeds, start indoors 6-8 weeks before the outdoor planting date.
                When transplanting seedlings, plant them deep so that the lower leaves are under the soil, which encourages strong root growth.</h4><br>
                <h4> 4. Regular Watering
                Tomatoes need consistent watering, especially during the growing period. Keep the soil moist but avoid waterlogging. Even watering helps prevent fruit cracking.
                Try to water the soil directly rather than the leaves to reduce the risk of fungal diseases.</h4><br>
                <h4> 5. Periodic Fertilization
                Use a fertilizer rich in potassium and phosphorus, essential for flowering and fruit formation. Apply fertilizer every 2-3 weeks depending on the type used.</h4><br>
                <h4>6. Pruning and Training
                Prune the lower leaves and side shoots that may hinder air circulation and increase disease risk. This helps direct the plant's energy toward fruit production.
                Use stakes or cages to support the plant and prevent stems from breaking under the weight of the fruit.</h4><br>
                <h4>7. Pest and Disease Prevention
                Regularly inspect plants for any signs of pests like spider mites and aphids, or diseases like powdery mildew or bacterial spots.
                Use organic or natural pesticides, such as neem oil or soap solution, if you notice any infestation to maintain plant health.</h4><br>
                <h4> 8. Harvesting
                Harvest tomatoes when they turn red or the color specific to the variety being grown. They can be picked at partial ripeness and allowed to ripen at room temperature.
                Be gentle when picking to avoid damaging the fruit or stems.</h4><br>
            </div>
          </div>
   
        </div>
        
</div>

 -->
















<div class="logo-container">
    <img src="images/tomato.png" alt="Logo" class="logo">
</div>

<script>
    let lastScrollTop = 0; // Store the last scroll position
    const logo = document.querySelector('.logo-container');

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop; // Current scroll position
        const rotation = (scrollTop - lastScrollTop) * 6; // Adjust the multiplier to control spin speed

        // Rotate the logo based on the scroll amount
        logo.style.transform = `rotate(${rotation}deg)`;

        lastScrollTop = scrollTop; // Update the last scroll position
    });
</script>















<?php

if (isset($_SESSION['farmer_name'])) {
    include 'footerafter.php';
    

    
    // Check if the user is an admin
   
} else {
    include 'footerbefore.php';
}
?>















    <script src="js/bootstrap.min.js"></script>
</body>
</html>



