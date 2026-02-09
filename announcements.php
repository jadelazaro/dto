<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements - Digital Transformation Office</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="assets/lucide.min.js"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes flare {
            0%, 100% {
                opacity: 0.6;
                transform: scaleY(1);
            }
            50% {
                opacity: 1;
                transform: scaleY(1.2);
            }
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
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body class="bg-gradient-to-br from-amber-900 via-red-900 to-slate-900 text-slate-900 min-h-screen">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-gradient-to-r from-amber-800 to-red-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-2 flex justify-between items-center">
            <div class="logo flex items-center gap-3">
                <img src="DTO outline (1).png" alt="DTO Logo" class="w-20 h-20 drop-shadow-lg">
                <h1 class="text-4xl font-bold leading-none">DTO</h1>
            </div>
            <nav class="hidden md:flex gap-6">
                <a href="index.php#home" class="hover:text-indigo-200 transition">Home</a>
                <a href="announcements.php" class="hover:text-indigo-200 transition font-bold text-amber-300">Announcements</a>
                <a href="news.php" class="hover:text-indigo-200 transition">News</a>
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
            <a href="announcements.php" class="hover:text-indigo-200 transition py-2 border-b border-amber-700 font-bold text-amber-300">Announcements</a>
            <a href="news.php" class="hover:text-indigo-200 transition py-2 border-b border-amber-700">News</a>
            <a href="calendar.php" class="hover:text-indigo-200 transition py-2 border-b border-amber-700">Calendar</a>
            <a href="index.php#faq" class="hover:text-indigo-200 transition py-2 border-b border-amber-700">FAQ</a>
            <a href="index.php#contact" class="hover:text-indigo-200 transition py-2">Contact</a>
        </div>
    </div>

    <!-- Main Content -->
    <section class="bg-white my-8 rounded-lg shadow-md p-4 md:p-8 max-w-7xl mx-4 md:mx-auto" id="announcements">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-green-800 border-b-4 border-green-800 pb-2 inline-block">All Announcements</h2>
                <p class="text-slate-600 mt-2">Click on any announcement box to view full details</p>
            </div>
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="flex items-center gap-2">
                    <label for="categoryFilter" class="text-green-800 font-semibold">Filter by Category:</label>
                    <select id="categoryFilter" class="px-4 py-2 border border-green-800 rounded-lg text-slate-900 bg-white cursor-pointer hover:border-green-600 transition focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        <option value="all">All Categories</option>
                        <option value="strategic">Strategic Initiatives</option>
                        <option value="program">Programs & Services</option>
                        <option value="assessment">Assessment Programs</option>
                    </select>
                </div>
                <button id="expandAllBtn" class="px-4 py-2 bg-green-800 text-white rounded-lg hover:bg-green-700 transition font-medium">Expand All</button>
                <button id="collapseAllBtn" class="px-4 py-2 bg-slate-800 text-white rounded-lg hover:bg-slate-700 transition font-medium">Collapse All</button>
            </div>
        </div>
        
        <!-- Announcements Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="announcementsGrid">
            
            <!-- Announcement 1 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="strategic" data-date="2025-01-15">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">15</div>
                    <div class="text-sm uppercase tracking-wide">January 2025</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">DIGITAL TRANSFORMATION ROADMAP 2026 LAUNCH</h3>
                        <span class="category-badge bg-green-800 text-white font-semibold">Strategic</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">We are excited to announce the launch of our comprehensive Digital Transformation Roadmap for 2026. This strategic initiative will modernize operations and enhance organizational efficiency.</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Click to expand</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">We are excited to announce the launch of our comprehensive Digital Transformation Roadmap for 2026. This strategic initiative will modernize operations and enhance organizational efficiency across all departments. The roadmap includes key milestones, resource allocation, and expected outcomes that will guide our transformation efforts throughout the year.</p>
                        <p class="text-slate-700 mb-4">Key focus areas include cloud migration, AI integration, cybersecurity enhancement, and process automation. All department heads are requested to review the roadmap and align their team objectives accordingly.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: January 15, 2025</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Announcement 2 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="program" data-date="2025-01-10">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">10</div>
                    <div class="text-sm uppercase tracking-wide">January 2025</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">NEW CLOUD MIGRATION INITIATIVE</h3>
                        <span class="category-badge bg-blue-600 text-white font-semibold">Program</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">Organizations can now participate in our Cloud Migration Initiative. Submit your migration requirements through our online portal to benefit from our digital transformation services.</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Click to expand</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">Organizations can now participate in our Cloud Migration Initiative. Submit your migration requirements through our online portal to benefit from our digital transformation services. This initiative provides support for migrating legacy systems to modern cloud platforms with minimal disruption to operations.</p>
                        <p class="text-slate-700 mb-4">Benefits include reduced infrastructure costs, improved scalability, enhanced security, and access to advanced cloud services. Our team of cloud specialists will provide guidance throughout the migration process.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: January 10, 2025</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Announcement 3 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="assessment" data-date="2025-01-05">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">05</div>
                    <div class="text-sm uppercase tracking-wide">January 2025</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">DIGITAL MATURITY ASSESSMENT PROGRAM</h3>
                        <span class="category-badge bg-purple-600 text-white font-semibold">Assessment</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">Organizations are now invited to participate in our Digital Maturity Assessment Program. Evaluate your digital capabilities and receive strategic recommendations.</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Click to expand</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">Organizations are now invited to participate in our Digital Maturity Assessment Program. Evaluate your digital capabilities and receive strategic recommendations. Submit your applications by the designated deadline.</p>
                        <p class="text-slate-700 mb-4">The assessment covers five key dimensions: strategy, culture, processes, technology, and data. Participants will receive a detailed report with actionable insights and a customized roadmap for digital improvement.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: January 5, 2025</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Announcement 4 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="strategic" data-date="2024-12-20">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">20</div>
                    <div class="text-sm uppercase tracking-wide">December 2024</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">CYBERSECURITY FRAMEWORK IMPLEMENTATION COMPLETE</h3>
                        <span class="category-badge bg-green-800 text-white font-semibold">Strategic</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">We have successfully implemented our comprehensive Cybersecurity Framework to protect organizational digital assets and ensure data privacy.</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Click to expand</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">We have successfully implemented our comprehensive Cybersecurity Framework to protect organizational digital assets and ensure data privacy. This framework is based on industry best practices and regulatory requirements.</p>
                        <p class="text-slate-700 mb-4">Key components include threat detection systems, access controls, encryption protocols, and employee training programs. Regular security audits will be conducted to maintain compliance and address emerging threats.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: December 20, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Announcement 5 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="program" data-date="2024-12-15">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">15</div>
                    <div class="text-sm uppercase tracking-wide">December 2024</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">NEW AI & AUTOMATION SERVICES LAUNCHED</h3>
                        <span class="category-badge bg-blue-600 text-white font-semibold">Program</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">Our newly launched AI and Automation Services are now available to help organizations optimize their digital operations and improve efficiency.</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Click to expand</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">Our newly launched AI and Automation Services are now available to help organizations optimize their digital operations and improve efficiency. These services include robotic process automation, machine learning solutions, and AI-driven analytics.</p>
                        <p class="text-slate-700 mb-4">Initial pilot programs have shown efficiency improvements of up to 40% in routine tasks. Interested departments should contact the Digital Transformation Office to schedule a consultation.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: December 15, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Announcement 6 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="assessment" data-date="2024-12-10">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">10</div>
                    <div class="text-sm uppercase tracking-wide">December 2024</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">ENTERPRISE ARCHITECTURE CERTIFICATION AVAILABLE</h3>
                        <span class="category-badge bg-purple-600 text-white font-semibold">Assessment</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">We are pleased to announce the availability of our Enterprise Architecture Certification program.</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Click to expand</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">We are pleased to announce the availability of our Enterprise Architecture Certification program. Enhance your digital transformation skills with our industry-recognized certification.</p>
                        <p class="text-slate-700 mb-4">The program includes modules on business architecture, information systems architecture, technology architecture, and implementation strategies. Certification exams will be held quarterly starting in March 2025.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: December 10, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Announcement 7 -->
            <div class="news-box bg-white rounded-lg shadow-lg border border-slate-200" data-category="strategic" data-date="2024-12-05">
                <div class="date-badge p-4 text-center rounded-t-lg">
                    <div class="text-2xl font-bold">05</div>
                    <div class="text-sm uppercase tracking-wide">December 2024</div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-green-800 line-clamp-2">Q4 DIGITAL TRANSFORMATION TARGETS MET</h3>
                        <span class="category-badge bg-green-800 text-white font-semibold">Strategic</span>
                    </div>
                    <p class="text-slate-700 mb-4 line-clamp-3">Congratulations! We have successfully achieved all Q4 digital transformation targets, positioning the organization for continued growth in 2026.</p>
                    <button class="news-toggle text-green-800 font-bold hover:underline flex items-center gap-1 w-full justify-center py-2 border-t border-slate-100">
                        <span>Click to expand</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="news-content">
                    <div class="p-4 pt-0 border-t border-slate-100">
                        <p class="text-slate-700 mb-4">Congratulations! We have successfully achieved all Q4 digital transformation targets, positioning the organization for continued growth in 2026. Key achievements include completion of three major system migrations and deployment of the new data analytics platform.</p>
                        <p class="text-slate-700 mb-4">Employee training programs have reached 95% completion, and user satisfaction with new digital tools has increased by 30% compared to last quarter. These results demonstrate our commitment to continuous improvement in digital capabilities.</p>
                        <div class="flex items-center text-slate-500 text-sm">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                            <span>Posted: December 5, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!-- No Results Message (Hidden by default) -->
        <div id="noResults" class="text-center py-12 hidden">
            <i data-lucide="inbox" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>
            <h3 class="text-xl font-bold text-slate-700 mb-2">No announcements found</h3>
            <p class="text-slate-500">Try selecting a different category or check back later for new announcements.</p>
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
        
        // Announcement box functionality
        document.addEventListener('DOMContentLoaded', function() {
            const newsBoxes = document.querySelectorAll('.news-box');
            const expandAllBtn = document.getElementById('expandAllBtn');
            const collapseAllBtn = document.getElementById('collapseAllBtn');
            const categoryFilter = document.getElementById('categoryFilter');
            const announcementsGrid = document.getElementById('announcementsGrid');
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
            
            // Expand all announcements
            expandAllBtn.addEventListener('click', function() {
                newsBoxes.forEach(box => {
                    box.classList.add('expanded');
                    const icon = box.querySelector('.news-toggle i');
                    icon.setAttribute('data-lucide', 'chevron-up');
                });
                lucide.createIcons();
            });
            
            // Collapse all announcements
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
                    announcementsGrid.classList.add('hidden');
                } else {
                    noResults.classList.add('hidden');
                    announcementsGrid.classList.remove('hidden');
                }
            });
            
            // Sort announcements by date (newest first)
            function sortAnnouncements() {
                const grid = document.getElementById('announcementsGrid');
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
            sortAnnouncements();
        });
    </script>
</body>
</html>
    </script>
</body>
</html>
