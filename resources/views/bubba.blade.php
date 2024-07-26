<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For Bub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .carousel-container {
            display: grid;
            grid-template-columns: 1fr; /* Default to 1 column */
            align-items: center;
            justify-items: center;
            overflow: hidden;
        }
        @media (min-width: 640px) {
            .carousel-container {
                grid-template-columns: 2fr 1fr; /* 2 columns on larger screens */
            }
        }
        .carousel {
            position: relative;
            width: 90%; /* Use percentage for responsiveness */
            height: 70vh; 
            transform-style: preserve-3d;
            animation: rotate 30s linear infinite;
            margin: 0 auto; /* Center the carousel */
        }
        .carousel-item {
            --i: 1;
            position: absolute;
            transform: rotateY(calc(var(--i) * 45deg)) translateZ(150px);
        }
        .carousel-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 10px; 
        }
        @keyframes rotate {
            from {
                transform: rotateY(0deg);
            }
            to {
                transform: rotateY(360deg);
            }
        }

        /* Modal Styles */
        .modal {
            display: none; 
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #888;
            width: 100%;
            max-width: 1200px;
            border-radius: 8px;
            margin: 1% auto;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            padding: 10px;
        }
        .image-border {
            border: 2px solid #ccc;
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
        }
        .modal-image {
            width: 350px; 
            height: 150px; 
            object-fit: cover; 
            border-radius: 10px;
            margin-bottom: 3rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease, z-index 0s ease;
            position: relative; /* Ensure z-index is applied */
            z-index: 1; /* Default stacking order */
        }
        .modal-image:hover {
            transform: scale(1.2); /* Enlarge the image more on hover */
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4); /* Add a shadow effect for more emphasis */
            z-index: 10; /* Bring the hovered image forward */
            position: absolute; /* Ensure it stays in place */
            left: 25%; /* Center the enlarged image horizontally */
            transform: translate(-50%, -50%) scale(1.5); /* Center and enlarge */
        }
        .flip-container {
            perspective: 1000px; 
            width: 150px; 
            height: 150px; 
            margin: 10px;
        }
        .flip-card {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            cursor: pointer;
        }
        .flip-card.flip {
            transform: rotateY(180deg); /* Flip the card */
        }
        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }
        .flip-card-front {
            background-color: #fff;
            border-radius: 10px;
        }
        .flip-card-back {
            background-color: #f9f9f9; /* Background for the text side */
            transform: rotateY(180deg); /* Position the back side */
            padding: 10px;
            border-radius: 10px;
            text-align: center;
        }
        .flip-card-back p {
            margin: 0;
            font-family: sans-serif;
            font-size: 14px; 
            color: #333;
        }
    </style>
</head>
<body class="bg-purple-300">

    <div class="container mx-auto px-4 mt-10">
        <h1 class="text-center text-4xl font-bold mb-8 text-pink-600">To My Bubba</h1>
        
        <div class="carousel-container">
            <div class="carousel">
                <div class="carousel-item" style="--i:1">
                    <img src="{{ asset('images/1.jpg') }}" alt="Example Image 1" class="carousel-image">
                </div>
                <div class="carousel-item" style="--i:2">
                    <img src="{{ asset('images/2.jpg') }}" alt="Example Image 2" class="carousel-image">
                </div>
                <div class="carousel-item" style="--i:3">
                    <img src="{{ asset('images/3.jpg') }}" alt="Example Image 3" class="carousel-image">
                </div>
                <div class="carousel-item" style="--i:4">
                    <img src="{{ asset('images/4.jpg') }}" alt="Example Image 4" class="carousel-image">
                </div>
                <div class="carousel-item" style="--i:5">
                    <img src="{{ asset('images/5.jpg') }}" alt="Example Image 5" class="carousel-image">
                </div>
            </div>
            <div class="flex flex-col space-y-4">
                <audio id="background-music" src="music/us.mp3" loop></audio>
                <button id="play-button" class="mr-6 bg-purple-500 hover:bg-purple-400 text-white font-bold py-2 px-4 border-b-4 border-purple-700 hover:border-purple-500 rounded">Play Me</button>
                <button id="open-popup" class="mr-6 bg-purple-500 hover:bg-purple-400 text-white font-bold py-2 px-4 border-b-4 border-purple-700 hover:border-purple-500 rounded">View and Flip</button>
                <button id="open-read-modal" class="mr-6 bg-purple-500 hover:bg-purple-400 text-white font-bold py-2 px-4 border-b-4 border-purple-700 hover:border-purple-500 rounded">Read</button>
                       
            </div>
        </div>

              	<!-- Alert Structure -->
                  <div id="alert" class="hidden fixed top-0 left-1/2 transform -translate-x-1/2 mt-4 px-4 py-2 bg-green-500 text-white rounded shadow-lg z-50 transition-opacity duration-300 ease-in-out opacity-0">
                    Thankful for the memories! I love you!!
                </div>                
                
      	<!-- Modal structure -->
          <div id="image-popup" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="grid-container">
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/6.jpg') }}" alt="Example Image 6" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">We look so cute here hng</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/7.jpg') }}" alt="Example Image 7" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Ih missing our nomnoms together</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/8.jpg') }}" alt="Example Image 8" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Niwang pa ikaw here hehe </p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/9.jpg') }}" alt="Example Image 9" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Aesthetic at its finest</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/10.jpg') }}" alt="Example Image 10" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Himos man eh</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/11.jpg') }}" alt="Example Image 11" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">The ultimate thumbs up of bubba haha</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/12.jpg') }}" alt="Example Image 12" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">I look wa ligo here</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/13.jpg') }}" alt="Example Image 13" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Hiding behind you kay shytype tahay</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/14.jpg') }}" alt="Example Image 14" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Idunno gaunsa ta ani before pero noicee</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/15.jpg') }}" alt="Example Image 15" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Niwang era</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/16.jpg') }}" alt="Example Image 16" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">First outing</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/18.jpg') }}" alt="Example Image 18" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Kadto ning time na may auntie nga nisulod kalit sa mcdo</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/19.jpg') }}" alt="Example Image 19" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Duty dutyy</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/20.jpg') }}" alt="Example Image 20" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Andrew E in the hauss</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/21.jpg') }}" alt="Example Image 21" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">How was your stay here tuod babyy?</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/22.jpg') }}" alt="Example Image 22" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Mwamwaaaa</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/23.jpg') }}" alt="Example Image 23" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Anam anam ka ug ka chubby na bubba</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/24.jpg') }}" alt="Example Image 24" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Our eyes speaks a lot of things</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/25.jpg') }}" alt="Example Image 25" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Boogsh naka porma hihi</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/26.jpg') }}" alt="Example Image 26" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Achieving things together</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/27.jpg') }}" alt="Example Image 27" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">First cinema date</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/28.jpg') }}" alt="Example Image 28" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Smile pa rin bisan larlar na</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/29.jpg') }}" alt="Example Image 29" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Eyy! Goalsss</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-container">
                        <div class="flip-card" data-flipped="false">
                            <div class="flip-card-front">
                                <img src="{{ asset('images/30.jpg') }}" alt="Example Image 30" class="modal-image">
                            </div>
                            <div class="flip-card-back flex items-center justify-center">
                                <p class="text-center font-serif font-semibold">Ending our studyante era together!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="read-modal" class="modal flex items-center justify-center">
            <div class="modal-content bg-white rounded-lg shadow-lg p-6">
                <span class="close text-gray-600 hover:text-gray-800 cursor-pointer">&times;</span>
                <h2 class="text-2xl font-bold mb-4">Dearest, Bubba</h2>
                <p class="text-lg text-gray-700 mb-4 text-justify" >It all started with a 5 peso coin and you messaging me, asking for images. We just clicked. I'm not sure why or how, but we did. We developed our friendship into something more. That something more is what we are now, in love. I am not sure about you, bub, but I am in love with you. I am frightened of what's coming, but I know we'll get through it together. Thank you for being understanding, patient, and making me feel loved. I apologize if I am stubborn and annoying at times, but that is who I am, and you have no choice but to deal with it hehe. Take care of yourself. We will see each other soon. I love you. bubba. Happy anniversary! TO MANY MORE SARYYY.</p>
                <p class="text-lg text-gray-700 mb-2">Yours truly,</p>
                <p class="text-lg font-semibold text-gray-800">Marie</p>
            </div>
        </div>
    
    </div>
  

    <div>
        <!-- Additional scripts -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var playButton = document.getElementById('play-button');
                var backgroundMusic = document.getElementById('background-music');
                var popup = document.getElementById('image-popup');
                var readModal = document.getElementById('read-modal');
                var openPopupButton = document.getElementById('open-popup');
                var openReadModalButton = document.getElementById('open-read-modal');
                var closeButtons = document.querySelectorAll('.close');
                var flipCards = document.querySelectorAll('.flip-card');
                var alertDiv = document.getElementById('alert');

                // Play button event listener
                playButton.addEventListener('click', function () {
                    backgroundMusic.play();
                });

                // Open popup button event listener
                openPopupButton.addEventListener('click', function () {
                    popup.style.display = 'block';
                });

                // Open read modal button event listener
                openReadModalButton.addEventListener('click', function () {
                    readModal.style.display = 'block';
                });

                // Close buttons event listener
                closeButtons.forEach(function (button) {
                    button.addEventListener('click', function () {
                        button.parentElement.parentElement.style.display = 'none';
                    });
                });

                // Flip card event listener
                flipCards.forEach(function (card) {
                card.addEventListener('click', function () {
                    card.classList.toggle('flip');
                    var isFlipped = card.getAttribute('data-flipped') === 'true';
                    card.setAttribute('data-flipped', !isFlipped);

                    // Check if all cards are flipped
                    var allFlipped = Array.from(flipCards).every(function (card) {
                        return card.getAttribute('data-flipped') === 'true';
                    });

                    if (allFlipped) {
                        // Show the alert with fade-in effect
                        alertDiv.classList.remove('hidden', 'opacity-0');
                        alertDiv.classList.add('opacity-100');
                        
                        // Hide after 2 seconds
                        setTimeout(function() {
                            alertDiv.classList.remove('opacity-100');
                            alertDiv.classList.add('opacity-0');
                            setTimeout(() => {
                                alertDiv.classList.add('hidden'); // Add hidden class after fade-out
                            }, 300); // Match this with the transition duration
                        }, 2000);
                    }
                });
            });
            });
        </script>
    </div>
</body>
</html>