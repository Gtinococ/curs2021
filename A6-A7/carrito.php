<!DOCTYPE html>
<html>
  <head>
    <title>Buy cool new product</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <section>
      <div class="product">
        <?php
        session_start();
        include 'funcions.php';
        foreach($_SESSION['arrayproductos'] as $valor){
          $conn = connectDB('localhost', 'gtinoco', 'gtinoco', 'gtinoco_productos_php');
          $sql = "select * from productes where id='$valor'";
          if (!$resultado=$conn->query($sql)) {
            die("error ejecutando la consulta:".$conn->error);
          }else{
            while($lista_productes = $resultado->fetch_assoc()){
              
              echo $lista_productes['id'];
              echo "-";
              echo $lista_productes['nom'];
              echo "-";
              echo $lista_productes['descripcio'];
              echo "-";
              echo $lista_productes['preu'];
              echo "<br>";
              echo "</br>";
            }
          }
        }
        ?>
        <div class="description">
          <h3>COMPRA DE <?php
          
          echo  $_SESSION["login"];
          ?></h3>
          <h5><?php
          echo $_SESSION['preciototal'];
           ?></h5>
        </div>
      </div>
      <button id="checkout-button">Checkout</button>
    </section>
  </body>
  <script type="text/javascript">
    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe("pk_test_51HotcSHjhQPwWzaAFFXyWuwqbWaGargYcdKS9VIf5PTsh4X4jEmLg91KqZgXd8YS6AxH6uT4aPLaAISy7wA6Fs3Y00Lg61dHlL");
    var checkoutButton = document.getElementById("checkout-button");
    checkoutButton.addEventListener("click", function () {
      fetch("create-session.php", {
        method: "POST",
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (session) {
          return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function (result) {
          // If redirectToCheckout fails due to a browser or network
          // error, you should display the localized error message to your
          // customer using error.message.
          if (result.error) {
            alert(result.error.message);
          }
        })
        .catch(function (error) {
          console.error("Error:", error);
        });
    });
  </script>
</html>