<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News - Digital Transformation Office</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="assets/lucide.min.js"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .news-box {
            transition: all 0.3s ease;
            cursor: pointer;
            overflow: hidden;
        }
        
        .news-content {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: max-height 0.5s ease, opacity 0.3s ease;
        }
        
        .news-box.expanded .news-content {
            max-height: 500px;
            opacity: 1;
        }
        
        .news-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .date-badge {
            background: linear-gradient(135deg, #047857, #065f46);
            color: white;
            transition: all 0.3s ease;
        }
        
        .news-box:hover .date-badge {
            background: linear-gradient(135deg, #065f46, #047857);
        }
        
        .category-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
        }
        
        .hero-title {
            text-shadow: 0 4px 0 rgba(139, 0, 0, 0.8), 0 8px 0 rgba(165, 0, 0, 0.6), 0 12px 20px rgba(0, 0, 0, 0.5);
            color: rgb(255 255 255 / 1);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-gradient-to-r from-amber-800 to-red-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-2 flex justify-between items-center">
            <div class="logo flex items-center gap-3">
                <img src="DTO outline (1).png" alt="DTO Logo" class="w-20 h-20 drop-shadow-lg">
                <h1 class="text-3xl font-bold">DTO</h1>
            </div>
            <nav class="hidden md:flex gap-6">
                <a href="index.php#home" class="hover:text-indigo-200 transition">Home</a>
                <a href="announcements.php" class="hover:text-indigo-200 transition">Announcements</a>
                <a href="news.php" class="hover:text-indigo-200 transition font-bold text-amber-300">News</a>
                <a href="calendar.php" class="hover:text-indigo-200 transition font-bold text-amber-300">Calendar</a>
                <a href="index.php#faq" class="hover:text-indigo-200 transition">FAQ</a>
                <a href="index.php#contact" class="hover:text-indigo-200 transition">Contact</a>
            </nav>
            <button class="md:hidden" id="mobileMenuBtn">
                <i data-lucide="menu" class="w-8 h-8 text-white"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div class="md:hidden hidden bg-gradient-to-r from-amber-800 to-red-900 text-white py-4 px-6" id="mobileMenu">
        <div class="flex flex-col gap-4">
            <a href="index.php#home" class="hover:text-indigo-200 transition py-2 border-b border-amber-700">Home</a>
            <a href="announcements.php" class="hover:text-indigo-200 transition py-2 border-b border-amber-700">Announcements</a>
            <a href="news.php" class="hover:text-indigo-200 transition py-2 border-b border-amber-700 font-bold text-amber-300">News</a>
            <a href="calendar.php" class="hover:text-indigo-200 transition py-2 border-b border-amber-700 font-bold text-amber-300">Calendar</a>
            <a href="index.php#faq" class="hover:text-indigo-200 transition py-2 border-b border-amber-700">FAQ</a>
            <a href="index.php#contact" class="hover:text-indigo-200 transition py-2">Contact</a>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative text-white min-h-[70vh] px-6 lg:px-8 text-center overflow-hidden flex items-center justify-center" id="home">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover" style="background-image: url('DTO PICS(1).jpg'); background-position: center; background-size: cover;"></div>
        
        <!-- Maroon Glassmorphism Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-amber-900 to-red-900 opacity-75 backdrop-blur-sm"></div>
        
        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 z-10 py-16">
            <h2 class="text-5xl lg:text-7xl font-black mb-6 drop-shadow-2xl hero-title">Latest News</h2>
            <p class="text-xl lg:text-2xl max-w-3xl mx-auto text-slate-100 drop-shadow-lg">Stay updated with our latest achievements, launches, and milestones in digital transformation</p>
        </div>
    </section>

    <!-- News Section -->
    <section class="bg-white my-8 rounded-lg shadow-lg p-4 md:p-8 max-w-7xl mx-4 md:mx-auto" id="news">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-green-800 border-b-4 border-green-800 pb-2 inline-block">All News</h2>
                <p class="text-slate-600 mt-2">Click on any news box to read the full story</p>
            </div>
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="flex items-center gap-2">
                    <label for="categoryFilter" class="text-green-800 font-semibold">Filter by Category:</label>
                    <select id="categoryFilter" class="px-4 py-2 border border-green-800 rounded-lg text-slate-900 bg-white cursor-pointer hover:border-green-600 transition focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        <option value="all">All Categories</option>
                        <option value="achievement">Achievements</option>
                        <option value="launch">Launches & Updates</option>
                        <option value="milestone">Milestones</option>
                    </select>
                </div>
                <button id="expandAllBtn" class="px-4 py-2 bg-green-800 text-white rounded-lg hover:bg-green-700 transition font-medium">Expand All</button>
                <button id="collapseAllBtn" class="px-4 py-2 bg-slate-800 text-white rounded-lg hover:bg-slate-700 transition font-medium">Collapse All</button>
            </div>
        </div>
        
        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="newsGrid">
            
            <!-- News 1 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="achievement" data-date="2025-01-29">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">29</div>
                    <div class="text-sm uppercase tracking-wide">January 2025</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">SUCCESSFUL ENTERPRISE TRANSFORMATION MILESTONE!</h3>
                        <span class="category-badge bg-green-600 text-white font-semibold">Achievement</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">We celebrate another successful enterprise digital transformation project. Our partner organization achieved their modernization goals ahead of schedule!</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Read full story</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">We celebrate another successful enterprise digital transformation project. Our partner organization achieved their modernization goals ahead of schedule, resulting in a 40% increase in operational efficiency and significant cost savings.</p>
                        <p class="text-slate-700 mb-4">The project involved migrating legacy systems to cloud platforms, implementing AI-driven analytics, and training over 500 employees on new digital tools. This success story demonstrates our commitment to delivering tangible results through strategic digital transformation.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: January 29, 2025</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- News 2 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="launch" data-date="2025-01-15">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">15</div>
                    <div class="text-sm uppercase tracking-wide">January 2025</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">NEW AI & AUTOMATION SERVICES LAUNCHED!</h3>
                        <span class="category-badge bg-blue-600 text-white font-semibold">Launch</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">Our newly launched AI and Automation Services are now available to help organizations optimize their digital operations and improve efficiency.</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Read full story</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">Our newly launched AI and Automation Services are now available to help organizations optimize their digital operations and improve efficiency. These services leverage cutting-edge machine learning algorithms and robotic process automation to streamline business processes.</p>
                        <p class="text-slate-700 mb-4">Initial implementations have shown remarkable results, with some clients reporting up to 60% reduction in manual processing time and 45% improvement in data accuracy. The services are available for both small businesses and large enterprises.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: January 15, 2025</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- News 3 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="milestone" data-date="2024-12-01">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">01</div>
                    <div class="text-sm uppercase tracking-wide">December 2024</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">CYBERSECURITY FRAMEWORK IMPLEMENTATION COMPLETE!</h3>
                        <span class="category-badge bg-purple-600 text-white font-semibold">Milestone</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">We have successfully implemented our comprehensive Cybersecurity Framework to protect organizational digital assets and ensure data privacy.</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Read full story</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">We have successfully implemented our comprehensive Cybersecurity Framework to protect organizational digital assets and ensure data privacy. This framework represents a significant milestone in our commitment to digital security.</p>
                        <p class="text-slate-700 mb-4">The framework includes advanced threat detection systems, multi-factor authentication, end-to-end encryption, and regular security audits. All partner organizations will benefit from enhanced protection against cyber threats, with a 99.9% uptime guarantee for critical security systems.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: December 1, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- News 4 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="achievement" data-date="2024-11-20">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">20</div>
                    <div class="text-sm uppercase tracking-wide">November 2024</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">PARTNERSHIP WITH LEADING TECH COMPANIES ANNOUNCED</h3>
                        <span class="category-badge bg-green-600 text-white font-semibold">Achievement</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">We are thrilled to announce strategic partnerships with leading technology companies to enhance our digital transformation capabilities.</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Read full story</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">We are thrilled to announce strategic partnerships with leading technology companies to enhance our digital transformation capabilities and deliver better solutions. These partnerships will provide access to cutting-edge technologies and expertise.</p>
                        <p class="text-slate-700 mb-4">Our new partners include industry leaders in cloud computing, artificial intelligence, and cybersecurity. These collaborations will enable us to offer more comprehensive solutions and accelerate digital transformation journeys for our clients.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: November 20, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- News 5 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="launch" data-date="2024-11-05">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">05</div>
                    <div class="text-sm uppercase tracking-wide">November 2024</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">DIGITAL MATURITY ASSESSMENT TOOL RELEASED</h3>
                        <span class="category-badge bg-blue-600 text-white font-semibold">Launch</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">Our new Digital Maturity Assessment Tool is now available online for organizations to evaluate their digital capabilities.</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Read full story</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">Our new Digital Maturity Assessment Tool is now available online. Organizations can use this tool to evaluate their current digital capabilities and receive personalized recommendations for improvement.</p>
                        <p class="text-slate-700 mb-4">The tool assesses five key dimensions: strategy, culture, processes, technology, and data. Users receive a detailed report with actionable insights and a customized roadmap for digital transformation. Over 200 organizations have already used the tool with excellent feedback.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: November 5, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- News 6 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="milestone" data-date="2024-10-15">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">15</div>
                    <div class="text-sm uppercase tracking-wide">October 2024</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">100 ORGANIZATIONS TRANSFORMED SUCCESSFULLY!</h3>
                        <span class="category-badge bg-purple-600 text-white font-semibold">Milestone</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">A major milestone! We have successfully helped 100 organizations complete their digital transformation journeys.</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Read full story</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">A major milestone! We have successfully helped 100 organizations complete their digital transformation journeys. Thank you for your trust and partnership!</p>
                        <p class="text-slate-700 mb-4">This achievement represents thousands of hours of dedicated work, collaboration, and innovation. Our 100th transformation project was completed for a mid-sized manufacturing company, resulting in a 50% reduction in operational costs and a 35% increase in productivity.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: October 15, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- News 7 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="achievement" data-date="2024-09-28">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">28</div>
                    <div class="text-sm uppercase tracking-wide">September 2024</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">RECEIVED INDUSTRY RECOGNITION FOR INNOVATION</h3>
                        <span class="category-badge bg-green-600 text-white font-semibold">Achievement</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">The DTO has been recognized by leading industry bodies for its innovative approaches to digital transformation.</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Read full story</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">The DTO has been recognized by leading industry bodies for its innovative approaches to digital transformation and continuous commitment to excellence. We received three prestigious awards at the Digital Innovation Summit 2024.</p>
                        <p class="text-slate-700 mb-4">Awards include "Most Innovative Digital Transformation Solutions," "Excellence in Client Success," and "Best Digital Maturity Framework." These recognitions validate our approach and motivate us to continue pushing the boundaries of digital innovation.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: September 28, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!-- No Results Message (Hidden by default) -->
        <div id="noResults" class="text-center py-12 hidden">
            <i data-lucide="inbox" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>
            <h3 class="text-xl font-bold text-slate-700 mb-2">No news articles found</h3>
            <p class="text-slate-500">Try selecting a different category or check back later for new updates.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="font-bold text-amber-500 mb-4">About DTO</h4>
                    <ul class="space-y-2">
                        <li><a href="index.html#home" class="text-slate-400 hover:text-amber-500 transition">Home</a></li>
                        <li><a href="index.html#about" class="text-slate-400 hover:text-amber-500 transition">About Us</a></li>
                        <li><a href="index.html#programs" class="text-slate-400 hover:text-amber-500 transition">Programs</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-amber-500 mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="index.html#faq" class="text-slate-400 hover:text-amber-500 transition">FAQ</a></li>
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

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                const icon = mobileMenuBtn.querySelector('i');
                if (mobileMenu.classList.contains('hidden')) {
                    icon.setAttribute('data-lucide', 'menu');
                } else {
                    icon.setAttribute('data-lucide', 'x');
                }
                lucide.createIcons();
            });
        }
        
        // News box functionality
        document.addEventListener('DOMContentLoaded', function() {
            const newsBoxes = document.querySelectorAll('.news-box');
            const expandAllBtn = document.getElementById('expandAllBtn');
            const collapseAllBtn = document.getElementById('collapseAllBtn');
            const categoryFilter = document.getElementById('categoryFilter');
            const newsGrid = document.getElementById('newsGrid');
            const noResults = document.getElementById('noResults');
            
            // Toggle individual news box
            newsBoxes.forEach(box => {
                const toggleBtn = box.querySelector('.news-toggle');
                const icon = toggleBtn.querySelector('i');
                
                toggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    box.classList.toggle('expanded');
                    
                    if (box.classList.contains('expanded')) {
                        icon.setAttribute('data-lucide', 'chevron-up');
                    } else {
                        icon.setAttribute('data-lucide', 'chevron-down');
                    }
                    lucide.createIcons();
                });
                
                // Also allow clicking anywhere on the box to expand (except the toggle button)
                box.addEventListener('click', function(e) {
                    if (!toggleBtn.contains(e.target)) {
                        box.classList.toggle('expanded');
                        
                        if (box.classList.contains('expanded')) {
                            icon.setAttribute('data-lucide', 'chevron-up');
                        } else {
                            icon.setAttribute('data-lucide', 'chevron-down');
                        }
                        lucide.createIcons();
                    }
                });
            });
            
            // Expand all news articles
            expandAllBtn.addEventListener('click', function() {
                newsBoxes.forEach(box => {
                    box.classList.add('expanded');
                    const icon = box.querySelector('.news-toggle i');
                    icon.setAttribute('data-lucide', 'chevron-up');
                });
                lucide.createIcons();
            });
            
            // Collapse all news articles
            collapseAllBtn.addEventListener('click', function() {
                newsBoxes.forEach(box => {
                    box.classList.remove('expanded');
                    const icon = box.querySelector('.news-toggle i');
                    icon.setAttribute('data-lucide', 'chevron-down');
                });
                lucide.createIcons();
            });
            
            // Filter functionality
            categoryFilter.addEventListener('change', function() {
                const selectedCategory = this.value;
                let visibleCount = 0;
                
                newsBoxes.forEach(box => {
                    const category = box.getAttribute('data-category');
                    
                    if (selectedCategory === 'all' || category === selectedCategory) {
                        box.style.display = 'block';
                        box.style.animation = 'fadeIn 0.3s ease-in';
                        visibleCount++;
                    } else {
                        box.style.display = 'none';
                    }
                });
                
                // Show/hide no results message
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                    newsGrid.classList.add('hidden');
                } else {
                    noResults.classList.add('hidden');
                    newsGrid.classList.remove('hidden');
                }
            });
            
            // Sort news by date (newest first)
            function sortNews() {
                const grid = document.getElementById('newsGrid');
                const boxes = Array.from(grid.querySelectorAll('.news-box'));
                
                boxes.sort((a, b) => {
                    const dateA = new Date(a.getAttribute('data-date'));
                    const dateB = new Date(b.getAttribute('data-date'));
                    return dateB - dateA; // Newest first
                });
                
                // Reorder boxes in the grid
                boxes.forEach(box => {
                    grid.appendChild(box);
                });
            }
            
            // Initial sort
            sortNews();
        });
    </script>
</body>
</html>