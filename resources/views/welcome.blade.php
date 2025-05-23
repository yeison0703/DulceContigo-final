@extends('layouts.app')

@section('content')

@if(session('login_success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: '¡Bienvenido!',
                text: '{{ session('login_success') }}',
                timer: 2000,
                showConfirmButton: false,
            });
        });
    </script>
@endif


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
      .hero {
        background-image: url('https://dynamic-media-cdn.tripadvisor.com/media/photo-o/27/8e/d4/58/el-amor-es-nuestro-ingrediente.jpg?w=800&h=-1&s=1');
        background-size: cover;
        background-position: center;
        height: 70vh;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
      }
      .hero h1 {
        font-size: 4rem;
        font-weight: bold;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
      }
      .hero h2{
          font-size: 2rem;
          font-weight: 300;
          text-shadow: 1px 1px 5px rgba(0,0,0,0.5);
      }
      .section-title {
        font-size: 2.5rem;
        margin-top: 40px;
      }
      .carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: #000;
     border-radius: 20%; 
}
footer {
    background: linear-gradient(90deg, rgb(15, 46, 27), rgb(20, 65, 38), rgb(18, 56, 32));
    color: #fff;
    padding: 20px 0 0 0; /* Menos padding arriba */
    text-align: center;
    font-family: 'Segoe UI', Arial, sans-serif;
    font-size: 0.98rem; /* Letra un poco más pequeña */
    letter-spacing: 0.01em;
}
.footer-content {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 40px; /* Menos espacio entre columnas */
    flex-wrap: wrap;
    padding-bottom: 5px; /* Menos padding abajo */
}
.footer-section {
    min-width: 180px;
    max-width: 260px;
    margin-bottom: 6px;
    text-align: left;
}
.footer-section h3 {
    font-size: 1.08rem;
    font-weight: 700;
    margin-bottom: 8px;
    color: #c28e00;
    letter-spacing: 0.03em;
}
.footer-section p,
.footer-section a {
    font-size: 0.98rem;
    margin-bottom: 5px;
    color: #fff;
    text-decoration: none;
    transition: color 0.2s;
    display: block;
    word-break: break-word;
}
.footer-section a:hover {
    color: #c28e00;
    text-decoration: none;
}
.footer-bottom {
    margin-top: 10px;
    border-top: 1px solid #444;
    padding: 8px 0 5px 0;
    font-size: 0.93rem;
    color: #e0e0e0;
    letter-spacing: 0.02em;
}
@media (max-width: 900px) {
    .footer-content {
        flex-direction: column;
        align-items: center;
        gap: 0;
    }
    .footer-section {
        width: 90%;
        max-width: 400px;
        text-align: center;
    }
}
@media (max-width: 600px) {
    .footer-section {
        width: 100%;
        min-width: 0;
        max-width: 100%;
        padding: 0 6px;
    }
    .footer-content {
        gap: 0;
    }
}

.content{
    height: 50vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

}
.about{
    height: 100vh;
    background-color:#eefaf39c;
 }
 .p1{
    margin-bottom: 10px;
    font-size: 30px;
    color: rgb(0, 0, 0);
    -webkit-text-stroke: .30px rgb(0, 0, 0);
    justify-content: center;
    margin-left: 60px;
    margin-right: 60px
    
}
.title2{
    font-size: 40px;
    font-weight: 400;
    text-transform: uppercase;
    color: rgb(23, 97, 63);
    text-align: center;
}
.text-success{

    --bs-text-opacity: 1;
    color: rgb(23 97 63) !important;
}

.py-5{
    padding-top: 5px !important;
    padding-bottom: 5px !important;
}
.mapa {
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 15px 0;
    box-sizing: border-box;
}
.mapa .container {
    max-width: 1100px; /* igual que el resto de tu contenido */
    width: 100%;
    padding: 0 15px;
}
.mapa1 {
    width: 100%;
    height: 50vh;
    min-height: 320px;
    border-radius: 5px;
    border: none;
    display: block;
    margin: 0 auto;
    max-width: 100%;
}
@media (max-width: 900px) {
    .mapa .container {
        max-width: 98vw;
        padding: 0 5px;
    }
    .mapa1 {
        height: 40vh;
        min-height: 200px;
    }
}
@media (max-width: 600px) {
    .mapa {
        padding: 8px 0;
    }
    .mapa .container {
        padding: 0 2px;
    }
    .mapa1 {
        height: 200px;
        min-height: 120px;
    }
}
 #btn-ir-arriba {
    position: fixed;
    bottom: 40px;
    right: 40px;
    z-index: 999;
    background: linear-gradient(90deg, rgb(15, 46, 27), rgb(20, 65, 38), rgb(18, 56, 32));
    color: #fff;
    border: none;
    border-radius: 100px;
    padding: 14px 28px;
    font-size: 1.1rem;
    font-weight: bold;
    box-shadow: 0 4px 16px rgba(0,0,0,0.18);
    cursor: pointer;
    transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
    display: none;
}
#btn-ir-arriba:hover {
    background: #c28e00;
    color: #fff;
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 8px 24px rgba(23,97,63,0.25);
}
@media (max-width: 600px) {
    #btn-ir-arriba {
        right: 16px;
        bottom: 16px;
        padding: 10px 18px;
        font-size: 0.95rem;
    }
}

    </style>
</head>
<body>

    <div class="container mt-4">
          <h2 class="section-title text-center mb-2 mt-2 text-success">Nuestro Catálogo</h2>

    <div id="categoriasCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @php
                $imagenes = [
                    'Postres'=>'https://0701.static.prezi.com/preview/v2/otksijunl3nhsozxhpzd4w3jnx6jc3sachvcdoaizecfr3dnitcq_3_0.png',
                    'Conservas'=>'https://img.restaurantguru.com/r21a-Dulce-Contigo-meals-2023-04.jpg',
                    'Dulces'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDfmKcylAaAaebemGiW48x945lQMRMHK6oGw&s',
                    //agregar nombre y url para mas categorias
        ];
            @endphp

            @foreach ($categorias as $index => $categoria)
                <div class="carousel-item @if($index == 0) active @endif">
                    <div class="d-flex justify-content-center align-items-center flex-column" style="height: 500px;">

                        <img src="{{ $imagenes[$categoria->nombre] ?? 'https://via.placeholder.com' }}" class="d-block w-100" alt="{{ $categoria->nombre }}"
                        style="height: 400px;">

                        <h5 class="mt-3">{{ $categoria->descripcion }}</h5>

                        <a href="{{ route('categorias.producto', $categoria->id) }}" class="btn btn-outline-dark">
                            {{ $categoria->nombre }}
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

      
        <button class="carousel-control-prev" type="button" data-bs-target="#categoriasCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#categoriasCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
   


</div>
<div class="container ">


<!-- Galería de Productos -->
<section class="py-5">
  <div class="container">
    <h2 class="section-title text-center text-success mt-2 ">Nuestros Postres Estrella</h2>
    <div class="row mt-4">
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/28/66/f1/66/las-fronteras-no-son.jpg?w=800&h=-1&s=1" class="card-img-top" alt="Cheesecake">
          <div class="card-body">
            <h5 class="card-title">Nutella</h5>
            <p class="card-text">Suave, cremoso y con el toque del chocolate. Un favorito de todos.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/28/1d/0c/8f/pensabas-que-no-podias.jpg?w=800&h=-1&s=1" class="card-img-top" alt="Cupcakes">
          <div class="card-body">
            <h5 class="card-title">Pimenton & aji rocoto</h5>
            <p class="card-text">Una mezcla increible entre dulce y picante.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/28/0e/d5/06/los-productos-mas-frescos.jpg?w=800&h=-1&s=1" class="card-img-top" alt="Brownie">
          <div class="card-body">
            <h5 class="card-title">Postre de maracuya</h5>
            <p class="card-text">Intenso, húmedo y refrescante.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Historia -->
<!-- Historia con animación -->
<section class="py-5" style="background: white;">
  <div class="container">
    <div class="row align-items-center">
      <!-- Imagen decorativa -->
      <div class="col-md-6 mb-4 mb-md-0" data-aos="fade-right">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/28/9b/f9/18/nuestra-tierra-antioquena.jpg?w=800&h=-1&s=1" 
             alt="Pasteles caseros" class="img-fluid rounded shadow-lg">
      </div>
      
      <!-- Texto de la historia -->
      <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
        <h2 class="section-title text-success mb-4">Nuestra Historia</h2>
        <p class="lead" style="font-size: 1.1rem;">
          Todo comenzó con <strong>Don Fabio</strong>, una apasionado repostero que heredó las recetas secretas de su abuela, 
          horneadas con amor y una pizca de magia. Cada pastel que preparaba era más que un postre: era un abrazo, 
          un recuerdo, una celebración.
        </p>
        <p class="lead" style="font-size: 1.1rem;">
          En 1998, Don Fabio decidió abrir <strong>Dulce Contigo</strong>, un rincón donde los sabores clásicos y las técnicas modernas 
          se combinan para crear experiencias inolvidables. Desde entonces, hemos endulzado miles de momentos con 
          nuestras creaciones artesanales.
        </p>
        <blockquote class="blockquote mt-4 text-muted" data-aos="fade-up" data-aos-delay="400">
          <p>“Preparamos y cocinamos felicidad, dia a dia.”</p>
        </blockquote>
      </div>
    </div>
  </div>
</section>

</section>


  <section class="mapa">
    <div class="container">
        <h2 class="section-title text-center text-success mt-2 ">¡VISITANOS!</h2>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15056.25382040731!2d-75.3812491455579!3d6.130658046120886!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e469f25f355a473%3A0xf27e907f9adde2f1!2sDulce%20Contigo!5e0!3m2!1ses!2sus!4v1713989889494!5m2!1ses!2sus"
            frameborder="0" class="mapa1"></iframe>
    </div>
</section>
   <footer>
    <div class="footer-content" id="contacto">
        <div class="footer-section">
            <h3>Contacto</h3>
            <p><i class="fa fa-envelope"></i> hola@dulcecontigo.com</p>
            <p><i class="fa fa-phone"></i> +57 322 540 18 55</p>
        </div>
        <div class="footer-section">
            <h3>Síguenos</h3>
            <a href="https://web.facebook.com/dulcecontigopostres/?_rdc=1&_rdr" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
            <a href="https://www.tiktok.com/@dulcecontigo" target="_blank"><i class="fab fa-tiktok"></i> TikTok</a>
            <a href="https://www.instagram.com/dulcecontigo/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; 2025. Todos los derechos reservados.
    </div>
</footer>

</div>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<a id="inicio"></a>
    {{-- ...código existente... --}}

    {{-- Botón "Ir arriba" --}}
    <button id="btn-ir-arriba" title="Ir arriba">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" style="vertical-align:middle;margin-bottom:3px;" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 12a.5.5 0 0 1-.5-.5V4.707L4.354 8.854a.5.5 0 1 1-.708-.708l4-4a.5.5 0 0 1 .708 0l4 4a.5.5 0 0 1-.708.708L8.5 4.707V11.5A.5.5 0 0 1 8 12z"/>
        </svg>
        
    </button>

    {{-- ...código existente... --}}

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
      AOS.init();

      // Mostrar/ocultar el botón según el scroll
      window.addEventListener('scroll', function() {
          const btn = document.getElementById('btn-ir-arriba');
          if (window.scrollY > 300) {
              btn.style.display = 'block';
          } else {
              btn.style.display = 'none';
          }
      });

      // Animación suave al hacer click
      document.getElementById('btn-ir-arriba').addEventListener('click', function() {
          window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    </script>
      
</body>
</html>



@endsection