<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Transformation Office - DTO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="assets/lucide.min.js"></script>
    <link rel="stylesheet" href="assets/restaurant-theme.css">
</head>
<body class="bg-slate-50 text-slate-900">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-gradient-to-r from-amber-800 to-red-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-2 flex justify-between items-center">
            <div class="logo flex items-center gap-3">
                <img src="DTO outline (1).png" alt="DTO Logo" class="w-20 h-20 drop-shadow-lg">
                <h1 class="text-4xl font-bold leading-none">DTO</h1>
            </div>
            <nav class="hidden md:flex gap-6 items-center">
                <a href="#home" class="hover:text-indigo-200 transition">Home</a>
                <a href="announcements.php" class="hover:text-indigo-200 transition">Announcements</a>
                <a href="news.php" class="hover:text-indigo-200 transition">News</a>
                <a href="calendar.php" class="hover:text-indigo-200 transition font-bold text-amber-300">Calendar</a>
                <a href="#faq" class="hover:text-indigo-200 transition">FAQ</a>
                <a href="#contact" class="hover:text-indigo-200 transition">Contact</a>
                <a href="login.php" class="ml-4 px-4 py-2 bg-white text-amber-900 rounded hover:bg-amber-50 transition font-medium">
                    <i data-lucide="log-in" class="w-4 h-4 inline mr-1"></i>
                    Login
                </a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative text-white min-h-screen px-6 lg:px-8 text-center overflow-hidden flex items-center justify-center" id="home">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover" style="background-image: url('DTO PICS(1).jpg'); background-position: center; background-size: cover;"></div>
        
        <!-- Maroon Glassmorphism Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-amber-900 to-red-900 opacity-75 backdrop-blur-sm"></div>
        
        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 z-10">
            <h2 class="text-6xl lg:text-8xl font-black mb-4 drop-shadow-2xl text-justify leading-tight" style="text-shadow: 0 4px 0 rgba(139, 0, 0, 0.8), 0 8px 0 rgba(165, 0, 0, 0.6), 0 12px 20px rgba(0, 0, 0, 0.5); color: rgb(255 255 255 / 1); word-spacing: 100vw;">DIGITAL TRANSFORMATION OFFICE</h2>
        </div>
    </section>

    <!-- Image Carousel Section -->
    <section class="py-12 px-4 md:px-8 bg-slate-100">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-8 text-center text-green-800 border-b-4 border-green-800 pb-3 inline-block">DTO Initiatives & Foresight</h2>
            
            <div class="relative overflow-hidden rounded-xl shadow-2xl mt-10">
                <!-- Carousel Container -->
                <div class="carousel-container relative h-[400px] md:h-[500px]">
                    <!-- Slide 1: Your Provided Banner -->
                    <div class="carousel-slide absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out opacity-100">
                        <div class="relative w-full h-full">
                            <img src="BANNER DTO updated (2).jpg" 
                                 alt="Digital Transformation Office Banner" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex items-end">
                                <div class="p-6 md:p-10 text-white">
                                    <h3 class="text-2xl md:text-3xl font-bold mb-2">Digital Transformation Office</h3>
                                    <p class="text-lg md:text-xl font-medium mb-1">Foresight and Future Thinking Office</p>
                                    <p class="text-slate-200 mt-3 max-w-2xl">Driving innovation through strategic foresight and digital transformation initiatives</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Slide 2: Additional DTO Image -->
                    <div class="carousel-slide absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out opacity-0">
                        <div class="relative w-full h-full">
                            <img src="DTO PICS(1).jpg" 
                                 alt="DTO Digital Initiatives" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-green-900/70 via-green-900/30 to-transparent flex items-end">
                                <div class="p-6 md:p-10 text-white">
                                    <h3 class="text-2xl md:text-3xl font-bold mb-2">Digital Strategy & Innovation</h3>
                                    <p class="text-lg md:text-xl font-medium mb-1">Transforming Organizations for the Digital Age</p>
                                    <p class="text-slate-200 mt-3 max-w-2xl">Implementing cutting-edge technologies and strategies to drive organizational success</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Slide 3: Placeholder for Future Content -->
                    <div class="carousel-slide absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out opacity-0">
                        <div class="relative w-full h-full bg-gradient-to-br from-amber-800 to-red-900 flex items-center justify-center">
                            <div class="text-center p-8 text-white">
                                <i data-lucide="cloud" class="w-24 h-24 mx-auto mb-6 opacity-80"></i>
                                <h3 class="text-2xl md:text-3xl font-bold mb-2">Cloud Migration Services</h3>
                                <p class="text-lg md:text-xl font-medium mb-1">Secure & Scalable Solutions</p>
                                <p class="text-slate-200 mt-3 max-w-2xl mx-auto">Helping organizations transition to cloud infrastructure for improved efficiency and scalability</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Slide 4: Placeholder for Future Content -->
                    <div class="carousel-slide absolute inset-0 w-full h-full transition-opacity duration-700 ease-in-out opacity-0">
                        <div class="relative w-full h-full bg-gradient-to-br from-green-800 to-amber-700 flex items-center justify-center">
                            <div class="text-center p-8 text-white">
                                <i data-lucide="shield" class="w-24 h-24 mx-auto mb-6 opacity-80"></i>
                                <h3 class="text-2xl md:text-3xl font-bold mb-2">Cybersecurity Implementation</h3>
                                <p class="text-lg md:text-xl font-medium mb-1">Protecting Digital Assets</p>
                                <p class="text-slate-200 mt-3 max-w-2xl mx-auto">Comprehensive security solutions to safeguard your organization's digital transformation journey</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Carousel Navigation -->
                <button class="carousel-prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-green-800 w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center shadow-lg transition-all hover:scale-110 z-10">
                    <i data-lucide="chevron-left" class="w-6 h-6"></i>
                </button>
                <button class="carousel-next absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-green-800 w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center shadow-lg transition-all hover:scale-110 z-10">
                    <i data-lucide="chevron-right" class="w-6 h-6"></i>
                </button>
                
                <!-- Carousel Dots -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2 z-10">
                    <button class="carousel-dot w-3 h-3 rounded-full bg-white/80 hover:bg-white transition-all" data-slide="0"></button>
                    <button class="carousel-dot w-3 h-3 rounded-full bg-white/40 hover:bg-white/60 transition-all" data-slide="1"></button>
                    <button class="carousel-dot w-3 h-3 rounded-full bg-white/40 hover:bg-white/60 transition-all" data-slide="2"></button>
                    <button class="carousel-dot w-3 h-3 rounded-full bg-white/40 hover:bg-white/60 transition-all" data-slide="3"></button>
                </div>
                
                <!-- Auto-play Indicator -->
                <div class="absolute top-4 right-4 z-10">
                    <button class="carousel-autoplay bg-black/40 hover:bg-black/60 text-white px-3 py-1 rounded-full text-sm flex items-center gap-2 transition-all">
                        <i data-lucide="play" class="w-4 h-4"></i>
                        <span>Auto</span>
                    </button>
                </div>
            </div>
            
            <!-- Carousel Description -->
            <div class="mt-8 text-center max-w-3xl mx-auto">
                <p class="text-slate-700 text-lg">Our Digital Transformation Office showcases strategic initiatives, foresight programs, and future-thinking approaches that drive organizational growth and innovation in the digital era.</p>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="bg-white rounded-lg shadow-md p-4 max-w-7xl md:mx-auto my-8" id="faq">
        <h2 class="text-2xl font-bold mb-4 text-green-800 border-b-4 border-green-800 pb-2">Frequently Asked Questions</h2>
        <div class="space-y-2" id="faqAccordion">
            <!-- FAQ 1 -->
            <div class="bg-slate-50 rounded-lg overflow-hidden border border-slate-200">
                <div class="faq-question bg-green-800 text-white p-4 cursor-pointer flex justify-between items-center hover:bg-green-700 transition-all duration-300">
                    <span class="font-medium">Who leads the Digital Transformation Office?</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300"></i>
                </div>
                <div class="faq-answer max-h-0 overflow-hidden bg-white transition-all duration-300">
                    <div class="p-4 pt-3 text-slate-700 border-t border-slate-100">
                        The DTO is led by Chief Digital Officer, John Doe, who has been directing digital transformation initiatives since 2020. He holds expertise in enterprise digital strategy.
                    </div>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-slate-50 rounded-lg overflow-hidden border border-slate-200">
                <div class="faq-question bg-green-800 text-white p-4 cursor-pointer flex justify-between items-center hover:bg-green-700 transition-all duration-300">
                    <span class="font-medium">What services does the Digital Transformation Office provide?</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300"></i>
                </div>
                <div class="faq-answer max-h-0 overflow-hidden bg-white transition-all duration-300">
                    <div class="p-4 pt-3 text-slate-700 border-t border-slate-100">
                        DTO provides Digital Strategy Consulting, Cloud Migration, AI & Automation, Cybersecurity Implementation, and Enterprise Transformation services to help organizations modernize operations.
                    </div>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-slate-50 rounded-lg overflow-hidden border border-slate-200">
                <div class="faq-question bg-green-800 text-white p-4 cursor-pointer flex justify-between items-center hover:bg-green-700 transition-all duration-300">
                    <span class="font-medium">Who are the team leads at DTO?</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300"></i>
                </div>
                <div class="faq-answer max-h-0 overflow-hidden bg-white transition-all duration-300">
                    <div class="p-4 pt-3 text-slate-700 border-t border-slate-100">
                        Jane Smith leads our Cloud Services Division, and Michael Johnson heads the Digital Strategy Division. Both bring extensive enterprise transformation expertise.
                    </div>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-slate-50 rounded-lg overflow-hidden border border-slate-200">
                <div class="faq-question bg-green-800 text-white p-4 cursor-pointer flex justify-between items-center hover:bg-green-700 transition-all duration-300">
                    <span class="font-medium">What is the mission and vision?</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300"></i>
                </div>
                <div class="faq-answer max-h-0 overflow-hidden bg-white transition-all duration-300">
                    <div class="p-4 pt-3 text-slate-700 border-t border-slate-100">
                        <strong class="text-green-800">Mission:</strong> To drive organizational digital transformation through innovative strategies and cutting-edge technologies.<br><br>
                        <strong class="text-green-800">Vision:</strong> To be the leading digital transformation office enabling organizations to thrive in the digital economy.
                    </div>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="bg-slate-50 rounded-lg overflow-hidden border border-slate-200">
                <div class="faq-question bg-green-800 text-white p-4 cursor-pointer flex justify-between items-center hover:bg-green-700 transition-all duration-300">
                    <span class="font-medium">How can my organization engage with DTO?</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300"></i>
                </div>
                <div class="faq-answer max-h-0 overflow-hidden bg-white transition-all duration-300">
                    <div class="p-4 pt-3 text-slate-700 border-t border-slate-100">
                        Organizations can contact us through our online portal or visit our office. Visit the Services section to learn about our engagement models and transformation packages.
                    </div>
                </div>
            </div>
            
            <!-- FAQ 6 (Additional for better visual) -->
            <div class="bg-slate-50 rounded-lg overflow-hidden border border-slate-200">
                <div class="faq-question bg-green-800 text-white p-4 cursor-pointer flex justify-between items-center hover:bg-green-700 transition-all duration-300">
                    <span class="font-medium">What are your office hours?</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300"></i>
                </div>
                <div class="faq-answer max-h-0 overflow-hidden bg-white transition-all duration-300">
                    <div class="p-4 pt-3 text-slate-700 border-t border-slate-100">
                        Our office is open Monday to Friday from 8:00 AM to 6:00 PM. You can also reach us via email anytime, and we typically respond within 24 hours.
                    </div>
                </div>
            </div>
            
            <!-- FAQ 7 (Additional for better visual) -->
            <div class="bg-slate-50 rounded-lg overflow-hidden border border-slate-200">
                <div class="faq-question bg-green-800 text-white p-4 cursor-pointer flex justify-between items-center hover:bg-green-700 transition-all duration-300">
                    <span class="font-medium">Do you offer training programs?</span>
                    <i data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300"></i>
                </div>
                <div class="faq-answer max-h-0 overflow-hidden bg-white transition-all duration-300">
                    <div class="p-4 pt-3 text-slate-700 border-t border-slate-100">
                        Yes, we offer comprehensive digital transformation training programs for organizations at various maturity levels. These include workshops, certification courses, and executive training sessions.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="bg-white my-8 rounded-lg shadow-md p-4 max-w-7xl md:mx-auto" id="contact">
        <h2 class="text-2xl font-bold mb-4 text-green-800 border-b-4 border-green-800 pb-2">Contact Us</h2>
        <div class="bg-slate-50 p-4 rounded-lg grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-start gap-4">
                <i data-lucide="map-pin" class="w-6 h-6 text-green-800 flex-shrink-0 mt-1"></i>
                <div>
                    <strong class="text-slate-900">Address:</strong>
                    <p class="text-slate-700">Pinaod, San Ildefonso, Bulacan</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <i data-lucide="phone" class="w-6 h-6 text-green-800 flex-shrink-0 mt-1"></i>
                <div>
                    <strong class="text-slate-900">Phone:</strong>
                    <p class="text-slate-700">(044) 931 8660</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <i data-lucide="mail" class="w-6 h-6 text-green-800 flex-shrink-0 mt-1"></i>
                <div>
                    <strong class="text-slate-900">Email:</strong>
                    <p><a href="mailto:dto@basc.edu.ph" class="text-green-800 hover:underline">dto@basc.edu.ph</a></p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <i data-lucide="clock" class="w-6 h-6 text-green-800 flex-shrink-0 mt-1"></i>
                <div>
                    <strong class="text-slate-900">Office Hours:</strong>
                    <p class="text-slate-700">Monday - Friday, 8:00 AM - 5:00 PM</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="font-bold text-amber-500 mb-4">About DTO</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-slate-400 hover:text-amber-500 transition">Home</a></li>
                        <li><a href="#about" class="text-slate-400 hover:text-amber-500 transition">About Us</a></li>
                        <li><a href="#programs" class="text-slate-400 hover:text-amber-500 transition">Programs</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-amber-500 mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="#faq" class="text-slate-400 hover:text-amber-500 transition">FAQ</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-amber-500 transition">Student Portal</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-amber-500 transition">Library</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-amber-500 mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-slate-400 hover:text-amber-500 transition">Terms of Service</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-amber-500 transition">Privacy Policy</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-amber-500 transition">Cookie Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-amber-500 mb-4">Connect</h4>
                    <div class="flex gap-3">
                        <a href="https://facebook.com" target="_blank" class="w-10 h-10 bg-green-800 rounded-full flex items-center justify-center hover:bg-red-900 transition">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <a href="https://twitter.com" target="_blank" class="w-10 h-10 bg-green-800 rounded-full flex items-center justify-center hover:bg-red-900 transition">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank" class="w-10 h-10 bg-green-800 rounded-full flex items-center justify-center hover:bg-red-900 transition">
                            <i data-lucide="instagram" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-700 pt-8 text-center text-slate-400">
                <p>Copyright © 2026 Digital Transformation Office. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Carousel Script -->
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Carousel Functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Carousel elements
            const slides = document.querySelectorAll('.carousel-slide');
            const dots = document.querySelectorAll('.carousel-dot');
            const prevBtn = document.querySelector('.carousel-prev');
            const nextBtn = document.querySelector('.carousel-next');
            const autoplayBtn = document.querySelector('.carousel-autoplay');
            
            let currentSlide = 0;
            let autoplayInterval;
            let isAutoplay = true;
            
            // Function to show a specific slide
            function showSlide(index) {
                // Hide all slides
                slides.forEach(slide => {
                    slide.style.opacity = '0';
                });
                
                // Remove active class from all dots
                dots.forEach(dot => {
                    dot.classList.remove('bg-white/80');
                    dot.classList.add('bg-white/40');
                });
                
                // Show the selected slide
                slides[index].style.opacity = '100';
                
                // Update dot
                dots[index].classList.remove('bg-white/40');
                dots[index].classList.add('bg-white/80');
                
                // Update current slide index
                currentSlide = index;
            }
            
            // Function to show next slide
            function nextSlide() {
                let nextIndex = currentSlide + 1;
                if (nextIndex >= slides.length) {
                    nextIndex = 0;
                }
                showSlide(nextIndex);
            }
            
            // Function to show previous slide
            function prevSlide() {
                let prevIndex = currentSlide - 1;
                if (prevIndex < 0) {
                    prevIndex = slides.length - 1;
                }
                showSlide(prevIndex);
            }
            
            // Function to start autoplay
            function startAutoplay() {
                if (isAutoplay) {
                    autoplayInterval = setInterval(nextSlide, 5000);
                    autoplayBtn.innerHTML = `<i data-lucide="pause" class="w-4 h-4"></i><span>Auto</span>`;
                    lucide.createIcons();
                }
            }
            
            // Function to stop autoplay
            function stopAutoplay() {
                clearInterval(autoplayInterval);
                autoplayBtn.innerHTML = `<i data-lucide="play" class="w-4 h-4"></i><span>Auto</span>`;
                lucide.createIcons();
            }
            
            // Function to toggle autoplay
            function toggleAutoplay() {
                isAutoplay = !isAutoplay;
                if (isAutoplay) {
                    startAutoplay();
                } else {
                    stopAutoplay();
                }
            }
            
            // Event Listeners
            prevBtn.addEventListener('click', () => {
                prevSlide();
                // Reset autoplay timer when manually navigating
                if (isAutoplay) {
                    clearInterval(autoplayInterval);
                    startAutoplay();
                }
            });
            
            nextBtn.addEventListener('click', () => {
                nextSlide();
                // Reset autoplay timer when manually navigating
                if (isAutoplay) {
                    clearInterval(autoplayInterval);
                    startAutoplay();
                }
            });
            
            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const slideIndex = parseInt(dot.getAttribute('data-slide'));
                    showSlide(slideIndex);
                    // Reset autoplay timer when manually navigating
                    if (isAutoplay) {
                        clearInterval(autoplayInterval);
                        startAutoplay();
                    }
                });
            });
            
            autoplayBtn.addEventListener('click', toggleAutoplay);
            
            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    prevSlide();
                } else if (e.key === 'ArrowRight') {
                    nextSlide();
                }
            });
            
            // Initialize carousel
            showSlide(0);
            startAutoplay();
            
            // Pause autoplay on hover
            const carouselContainer = document.querySelector('.carousel-container');
            carouselContainer.addEventListener('mouseenter', stopAutoplay);
            carouselContainer.addEventListener('mouseleave', () => {
                if (isAutoplay) {
                    startAutoplay();
                }
            });
        });

        // FAQ Toggle with smooth animation
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                const icon = this.querySelector('i');
                
                // Close all other FAQs
                document.querySelectorAll('.faq-answer').forEach(faq => {
                    if (faq !== answer && faq.classList.contains('active')) {
                        faq.classList.remove('active');
                        faq.style.maxHeight = '0';
                        faq.previousElementSibling.querySelector('i').innerHTML = lucide.icons.plus.toSvg();
                        lucide.createIcons();
                    }
                });

                // Toggle current FAQ
                if (answer.classList.contains('active')) {
                    answer.classList.remove('active');
                    answer.style.maxHeight = '0';
                    icon.innerHTML = lucide.icons.plus.toSvg();
                } else {
                    answer.classList.add('active');
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    icon.innerHTML = lucide.icons.minus.toSvg();
                }
                lucide.createIcons();
            });
        });

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
        });
    </script>

    <style>
        /* Carousel Styles */
        .carousel-slide {
            transition: opacity 0.7s ease-in-out;
        }
        
        .carousel-dot {
            transition: all 0.3s ease;
        }
        
        .carousel-dot:hover {
            transform: scale(1.2);
        }
        
        .carousel-prev, .carousel-next {
            backdrop-filter: blur(4px);
        }
        
        /* FAQ Styles */
        .faq-question {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        
        .faq-question:active {
            transform: scale(0.98);
        }
        
        .faq-answer {
            transition: max-height 0.3s ease;
        }
        
        .faq-answer div {
            line-height: 1.6;
        }
        
        .faq-question:hover {
            background-color: #065f46 !important;
        }
        
        .faq-question:focus {
            outline: 2px solid #065f46;
            outline-offset: 2px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .carousel-container {
                height: 350px;
            }
            
            .carousel-prev, .carousel-next {
                width: 8px;
                height: 8px;
            }
        }
        
        @media (max-width: 480px) {
            .carousel-container {
                height: 300px;
            }
        }
    </style>
</body>
</html>