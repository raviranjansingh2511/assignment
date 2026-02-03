<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Deposit Not Found | LocknPay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'] } }}
        }
    </script>
    <style>
        body { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); }
        .glitch { animation: glitch 4s infinite; }
        @keyframes glitch {
            0%,100% { clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%); }
            10% { clip-path: polygon(0 0, 100% 0, 100% 35%, 0 65%); }
            20% { clip-path: polygon(0 30%, 100% 0, 100% 70%, 0 100%); }
            30% { clip-path: polygon(0 10%, 100% 20%, 100% 90%, 0 80%); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 relative overflow-hidden">

<div class="max-w-4xl w-full text-center z-10">
    <!-- Killer 404 -->
    <h1 class="glitch text-9xl md:text-[200px] font-black text-white drop-shadow-2xl tracking-tighter leading-none">
        4<span class="inline-block animate-pulse text-yellow-300">0</span>4
    </h1>

    <!-- Perfect Sentence -->
    <div class="mt-10 space-y-6">
        <h2 class="text-4xl md:text-6xl font-extrabold text-white">
            Oops! Deposit Not Found
        </h2>
        <p class="text-xl md:text-2xl text-indigo-100 max-w-3xl mx-auto leading-relaxed font-medium">
            The deposit you're looking for <span class="text-yellow-300 font-bold">does not exist</span>, 
            has been <span class="text-red-300 font-bold">deleted</span>, or 
            the link has <span class="text-pink-300 font-bold">expired</span>.
        </p>
        <p class="text-lg text-indigo-200 mt-4">
            Don't worry — it happens! Make sure you copied the full deposit link correctly.
        </p>
    </div>

    <!-- Buttons -->
    <div class="mt-12 flex flex-col sm:flex-row gap-6 justify-center items-center">
        <a href="/admin/dashboard" 
           class="px-12 py-6 bg-white text-indigo-600 font-bold text-xl rounded-2xl shadow-2xl hover:shadow-indigo-500/60 transform hover:scale-105 transition-all duration-300 flex items-center gap-3">
            ← Go Back to Home
        </a>
        
    </div>

    {{-- <!-- Pro Tip -->
    <div class="mt-16 text-indigo-200 text-lg font-medium">
        <p>Pro Tip: Always copy the full link — no extra spaces!</p>
    </div> --}}
</div>

<!-- Floating Magic Background -->
<div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none">
    <div class="absolute top-20 left-20 w-96 h-96 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
    <div class="absolute top-40 right-10 w-80 h-80 bg-yellow-500 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-blob animation-delay-2000"></div>
    <div class="absolute bottom-10 left-40 w-96 h-96 bg-pink-600 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>
</div>

<style>
    @keyframes blob {
        0%, 100% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }
    .animate-blob { animation: blob 8s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
</style>

</body>
</html>