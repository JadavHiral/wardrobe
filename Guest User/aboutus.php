<?php
$title_page = "About Us";
ob_start();
?>

<style>
 
    body {
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #fffaf8;
            color: #222;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.45;
        }

  /* HERO */
  .about-hero {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 60px 8vw;
    flex-wrap: wrap;
    background: linear-gradient(90deg, #f7ded4ff 50%, #e7b0c3ff 100%);
  }

  .about-text {
    flex: 1 1 400px;
  }

  .about-text h1 {
    font-size: 38px;
    color: #111827;
    margin-bottom: 14px;
  }

  .about-text h1 span {
    color: #ff6f91;
  }

  .about-text p {
    color: #374151;
    font-size: 17px;
    max-width: 500px;
    line-height: 1.6;
  }

  .about-img {
    flex: 1 1 360px;
    width: 100%;
    height: 300px;
    border-radius: 10px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
  }

  /* SECTIONS */
  .about-section {
    padding: 60px 8vw;
    max-width: 1200px;
    margin: auto;
    text-align: center;
  }

  .about-section h2 {
    font-size: 28px;
    color: #111827;
    margin-bottom: 16px;
  }

  .about-section p {
    max-width: 780px;
    margin: auto;
    color: #090a0aff;
    line-height: 1.6;
  }

  /* MISSION */
   .mission-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
  }

  .mission-card {
    background:  #edccd7ff;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    padding: 25px;
    width: 300px;
    transition: transform 0.3s ease;
  }

  .mission-card:hover {
    transform: translateY(-5px);
  }

  .mission-card h3 {
    color: #050005ff;
    font-size: 20px;
    margin-bottom: 10px;
  }

  .mission-card p {
    color: #374151;
    font-size: 15px;
    line-height: 1.6;
  }


  /* CTA */
  .about-cta {
    text-align: center;
    padding: 70px 8vw;
    background: linear-gradient(90deg, #111827, #1f2937);
    color: #fff;
  }

  .about-cta h2 {
    font-size: 26px;
    margin-bottom: 10px;
  }

  .about-cta p {
    color: #d1d5db;
    margin-bottom: 20px;
    font-size: 16px;
  }



  .about-cta .btn-primary:hover {
    transform: translateY(-3px);
  }

  @media (max-width: 768px) {
    .about-hero {
      flex-direction: column;
      text-align: center;
    }

    .about-img {
      margin-top: 20px;
      width: 100%;
    }
    .mission-card {
      width: 90%;
    }
  }
</style>

<!-- HERO -->
<div class="about-hero">
  <div class="about-text">
    <h1>About <span>StyleHub</span></h1>
    <p>Where tradition meets trend. At StyleHub, we celebrate Indian elegance with a touch of modern minimalism — making every outfit a story of confidence and comfort.</p>
  </div>
  <img src="images/workspace.jpg" alt="StyleHub studio" class="about-img" />
</div>

<!-- STORY -->
<section class="about-section">
  <h2>Our Story</h2>
  <p>Founded in 2021, StyleHub was born from a love for fashion that blends heritage and innovation. From handcrafted traditional wear to sleek western outfits, we bring thoughtfully curated styles to your wardrobe — for every mood, every day.</p>
</section>

<!-- MISSION -->
<section class="about-section">
  <h2>Our Mission</h2>
  <div class="mission-grid">

    <div class="mission-card">
      <h3>Style for Everyone</h3>
      <p>We create fashion that fits every body, mood, and moment — with comfort and confidence.</p>
    </div>

    <div class="mission-card">
      <h3>Made to Last</h3>
      <p>Our designs are crafted with quality and care, built to look good and feel great for years.</p>
    </div>

    <div class="mission-card">
      <h3>Responsible Fashion</h3>
      <p>We believe in mindful choices — from materials to making — for a better tomorrow.</p>
    </div>

  </div>
</section>



<!-- CTA -->
<section class="about-cta">
  <h2>Style That Speaks You</h2>
  <p> Every design we create blends comfort, confidence, and culture.</p>
  <a href="category.php" class="btn-primary">Shop Now</a>
</section>

<?php
$content1 = ob_get_clean();
include_once("layout.php");
?>