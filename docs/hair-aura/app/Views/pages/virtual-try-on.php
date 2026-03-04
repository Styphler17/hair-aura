<?php
/**
 * Virtual Try-On Page
 * 
 * @var array $seo
 */
?>

<!-- Luxelocks Luxury Theme & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest"></script>

<style>
:root {
    --gold: #D4AF37;
    --cream: #F5F2ED;
    --onyx: #1A1A1A;
    --font-serif: "Cormorant Garamond", serif;
    --font-sans: "Inter", sans-serif;
}

.virtual-tryon-page {
    background-color: var(--cream);
    color: var(--onyx);
    font-family: var(--font-sans);
    min-height: 100vh;
}

.font-serif { font-family: var(--font-serif); }

.luxury-card {
    background: white;
    border-radius: 2rem;
    box-shadow: 0 20px 40px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.05);
    overflow: hidden;
}

.gold-button {
    background: var(--onyx);
    color: var(--cream);
    padding: 0.75rem 2rem;
    border-radius: 9999px;
    font-weight: 500;
    letter-spacing: 0.05em;
    transition: all 0.3s ease;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
}

.gold-button:hover {
    background: var(--gold);
    color: var(--onyx);
    transform: translateY(-2px);
}

.glass-panel {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.state-section { display: none; }
.state-active { display: block; }

/* Custom Scrollbar */
.custom-scrollbar::-webkit-scrollbar { width: 4px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: var(--onyx); border-radius: 10px; }

@keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
@keyframes pulse { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.5; transform: scale(1.1); } }
.animate-spin { animation: spin 4s linear infinite; }
.animate-pulse { animation: pulse 2s infinite; }
.cursor-grab { cursor: grab; }
.cursor-grabbing { cursor: grabbing; }
.cursor-move { cursor: move; }
.mirror-mode { transform: scaleX(-1); }
.inset-0 { top: 0; left: 0; right: 0; bottom: 0; }
.x-small { font-size: 0.7rem; }
.style-item-card {
    border: 1px solid rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}
.style-item-card:hover {
    border-color: var(--gold);
    background: rgba(212, 175, 55, 0.05);
}
.style-item-card.active {
    border-color: var(--gold);
    background: rgba(212, 175, 55, 0.1);
    box-shadow: 0 10px 20px rgba(212, 175, 55, 0.1);
}
</style>

<div class="virtual-tryon-page pt-5">
    <div class="container py-5">
        
        <!-- Header -->
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div class="d-flex align-items-center gap-2 cursor-pointer" onclick="location.reload()">
                <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i data-lucide="scissors" class="text-gold" style="width: 20px;"></i>
                </div>
                <h1 class="font-serif fw-bold mb-0" style="font-size: 1.5rem; letter-spacing: -0.02em;">HAIR AURA</h1>
            </div>
            
            <div id="navBack" class="d-none">
                <button onclick="location.reload()" class="btn btn-link text-dark text-decoration-none fw-medium d-flex align-items-center gap-2">
                    <i data-lucide="chevron-left" style="width: 16px;"></i>
                    Back to Home
                </button>
            </div>
        </header>

        <main id="studioMain">
            
            <!-- LANDING STATE -->
            <section id="state-landing" class="state-section state-active animate__animated animate__fadeIn">
                <div class="text-center py-5">
                    <span class="text-uppercase tracking-widest fw-bold text-gold small d-block mb-3" style="letter-spacing: 0.3em;">The Future of Hair Styling</span>
                    <h2 class="font-serif display-1 fw-light mb-4">Find your <span class="fst-italic text-gold">perfect</span> look.</h2>
                    <p class="lead text-muted mx-auto mb-5" style="max-width: 600px;">
                        Experience professional hair transformations instantly with our AI-powered virtual studio. 
                        Try on premium wigs and styles with studio-quality realism.
                    </p>
                    
                    <div class="d-flex flex-column flex-md-row gap-4 justify-content-center pt-4">
                        <button onclick="changeState('capture', 'camera')" class="gold-button">
                            <i data-lucide="camera"></i> Live Mirror
                        </button>
                        <button onclick="changeState('capture', 'upload')" class="btn btn-outline-dark rounded-pill px-5 fw-medium d-flex align-items-center gap-2">
                            <i data-lucide="upload"></i> Upload Photo
                        </button>
                    </div>
                </div>
            </section>

            <!-- CAPTURE STATE -->
            <section id="state-capture" class="state-section animate__animated animate__fadeIn">
                <div class="mx-auto" style="max-width: 600px;">
                    <div class="luxury-card ratio ratio-3x4 bg-black mb-4">
                        <div id="cameraView" class="d-none">
                            <video id="webcam" autoplay playsinline class="w-100 h-100 object-fit-cover mirror-mode"></video>
                            <div class="position-absolute bottom-0 start-0 end-0 p-5 d-flex justify-content-center">
                                <button onclick="capturePhoto()" class="btn btn-white rounded-circle p-1 border-4 border-white" style="width: 80px; height: 80px;">
                                    <div class="bg-white rounded-circle w-100 h-100"></div>
                                </button>
                            </div>
                        </div>
                        <div id="uploadView" class="d-none h-100">
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 p-5 text-center cursor-pointer" onclick="document.getElementById('fileInput').click()">
                                <div class="bg-cream rounded-circle p-4 mb-4">
                                    <i data-lucide="upload" class="text-dark" style="width: 32px; height: 32px;"></i>
                                </div>
                                <h3 class="font-serif h2 mb-2">Drop your portrait here</h3>
                                <p class="text-muted">or click to browse from your device</p>
                                <p class="mt-5 text-gold text-uppercase small fw-bold tracking-widest">Best results with clear front-facing photos</p>
                            </div>
                        </div>
                        <canvas id="captureCanvas" class="d-none"></canvas>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted small mb-0">Step 1: Capture or Upload your photo</p>
                        <button onclick="toggleCaptureMode()" id="btnToggleMode" class="btn btn-link text-gold text-decoration-none small fw-bold p-0">
                            Switch to Upload
                        </button>
                    </div>
                </div>
                <input type="file" id="fileInput" class="d-none" accept="image/*">
            </section>

            <!-- STYLING STATE -->
            <section id="state-styling" class="state-section animate__animated animate__fadeIn">
                <div class="row g-5 align-items-start">
                    <div class="col-lg-7">
                        <div id="stylingContainer" class="luxury-card ratio ratio-3x4 bg-dark overflow-hidden position-relative">
                            <img id="baseImage" src="" class="w-100 h-100 object-fit-cover opacity-75">
                            
                            <!-- Draggable Wig Guide -->
                            <div id="wigGuide" class="position-absolute cursor-grab" style="top: 20%; left: 25%; width: 50%; z-index: 10;">
                                <img id="wigGuideImg" src="" class="w-100 h-auto opacity-75" style="mix-blend-mode: screen;">
                                <div class="position-absolute inset-0 border border-gold border-opacity-25 rounded" style="pointer-events: none;"></div>
                            </div>

                            <div class="position-absolute bottom-0 start-0 end-0 p-4 d-flex justify-content-between align-items-center">
                                <div class="glass-panel rounded-pill px-3 py-1 small d-flex align-items-center gap-2 text-uppercase tracking-widest" style="font-size: 10px;">
                                    <i data-lucide="move" style="width: 12px;"></i> Drag to Position
                                </div>
                                <div class="glass-panel rounded-pill px-3 py-1 small d-flex align-items-center gap-2 text-uppercase tracking-widest" style="font-size: 10px;">
                                    <i data-lucide="maximize" style="width: 12px;"></i> Scale: <span id="scaleLabel">1.0</span>x
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <i data-lucide="maximize" class="text-muted" style="width: 16px;"></i>
                                <input type="range" id="scaleRange" class="form-range" min="0.5" max="2.0" step="0.1" value="1.0">
                            </div>
                            <button onclick="applyAITransformation()" class="gold-button w-100 justify-content-center py-3">
                                <i data-lucide="sparkles"></i> Apply AI Transformation
                            </button>
                        </div>
                    </div>
                    
                    <div class="col-lg-5">
                        <h3 class="font-serif h1 mb-4">Select Style</h3>
                        
                        <!-- Categories Filter -->
                        <div id="categoryFilters" class="d-flex flex-wrap gap-2 mb-4">
                            <button class="btn btn-dark rounded-pill px-3 py-1 small text-uppercase tracking-widest fw-bold active" onclick="filterStyles('all', this)">all</button>
                            <button class="btn btn-outline-dark border-opacity-10 rounded-pill px-3 py-1 small text-uppercase tracking-widest fw-bold" onclick="filterStyles('long', this)">long</button>
                            <button class="btn btn-outline-dark border-opacity-10 rounded-pill px-3 py-1 small text-uppercase tracking-widest fw-bold" onclick="filterStyles('short', this)">short</button>
                            <button class="btn btn-outline-dark border-opacity-10 rounded-pill px-3 py-1 small text-uppercase tracking-widest fw-bold" onclick="filterStyles('curly', this)">curly</button>
                        </div>

                        <div id="stylesGrid" class="custom-scrollbar overflow-auto pe-2" style="max-height: 500px;">
                            <!-- Style options injected here -->
                        </div>
                    </div>
                </div>
            </section>

            <!-- PROCESSING STATE -->
            <section id="state-processing" class="state-section animate__animated animate__fadeIn">
                <div class="d-flex flex-column align-items-center justify-content-center py-5">
                    <div class="position-relative mb-5" style="width: 200px; height: 200px;">
                        <div class="position-absolute inset-0 border-top border-gold rounded-circle" style="animation: spin 4s linear infinite; border-width: 2px;"></div>
                        <div class="position-absolute inset-0 p-3 grayscale opacity-50 rounded-circle overflow-hidden">
                            <img id="processingImage" src="" class="w-100 h-100 object-fit-cover rounded-circle">
                        </div>
                        <div class="position-absolute inset-0 d-flex align-items-center justify-content-center">
                            <i data-lucide="sparkles" class="text-gold animate-pulse" style="width: 40px; height: 40px;"></i>
                        </div>
                    </div>
                    <h3 class="font-serif h2 mb-2 text-center">Crafting your look...</h3>
                    <p class="text-muted text-center" id="processingText">Our AI is blending the selected style with your features.</p>
                </div>
            </section>

            <!-- RESULT STATE -->
            <section id="state-result" class="state-section animate__animated animate__fadeIn">
                <div class="row g-5">
                    <div class="col-lg-7">
                        <div id="resultContainer" class="luxury-card ratio ratio-3x4 bg-dark mb-4 position-relative">
                            <img id="resultImage" src="" class="w-100 h-100 object-fit-cover">
                            <div id="compareOverlay" class="position-absolute top-0 start-0 w-100 h-100 d-none">
                                <img id="compareImage" src="" class="w-100 h-100 object-fit-cover">
                            </div>
                            <div class="position-absolute top-0 start-0 m-4">
                                <div class="glass-panel rounded-pill px-3 py-1 small fw-bold text-uppercase tracking-widest d-flex align-items-center gap-2">
                                    <i data-lucide="sparkles" class="text-gold" style="width: 12px;"></i> AI Enhanced
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3">
                            <button onclick="downloadResult()" class="gold-button flex-fill justify-content-center py-3">
                                <i data-lucide="download"></i> Save Look
                            </button>
                            <button onclick="toggleCompare()" class="btn btn-outline-dark rounded-pill px-4" id="btnCompare">
                                <i data-lucide="columns"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="col-lg-5">
                        <div class="mb-5">
                            <h3 class="font-serif h1 mb-2">Try another style</h3>
                            <p class="text-muted fw-light">Select a different hairstyle to see it instantly.</p>
                        </div>

                        <div id="resultStylesList" class="space-y-3 custom-scrollbar overflow-auto pe-2" style="max-height: 400px;">
                            <!-- Injected mini-items -->
                        </div>

                        <div class="bg-dark text-white p-4 rounded-4 mt-5">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="bg-gold bg-opacity-20 rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i data-lucide="user" class="text-gold" style="width: 20px;"></i>
                                </div>
                                <div class="lh-sm">
                                    <h4 class="font-serif h5 mb-0">Style Consultation</h4>
                                    <p class="text-gold text-uppercase x-small tracking-widest mb-0 opacity-50" style="font-size: 10px;">Expert Tip</p>
                                </div>
                            </div>
                            <p class="small fw-light opacity-75 mb-0" id="expertTip">
                                This style complements your face shape beautifully. It's best paired with minimal accessories for a clean, luxury look.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>

<script type="module">
import { GoogleGenerativeAI } from "https://esm.run/@google/generative-ai";

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide icons
    lucide.createIcons();
    
    // Global State
    let currentState = 'landing';
    let captureMode = 'camera'; // 'camera' or 'upload'
    let selectedStyleId = null;
    let baseImageData = null;
    let resultImageData = null;
    let wigGuides = {}; // Cached guide images
    
    // Style Data
    const styles = [
        { id: 'bone-straight', name: 'Bone Straight', category: 'long', image: 'bone-straight-icon.png', guide: 'bone-straight-guide.png', prompt: 'luxurious bone-straight jet black hair, 8k resolution, ultra-realistic texture, professional salon lighting, seamless hairline integration, cinematic shadows, high fashion editorial look' },
        { id: 'body-wave', name: 'Body Wave', category: 'long', image: 'body-wave-icon.png', guide: 'body-wave-guide.png', prompt: 'voluminous bouncy body-wave hair with rich chocolate brown tones, 8k resolution, realistic hair physics, soft studio lighting, perfect forehead blending, depth and dimension' },
        { id: 'pixie-curls', name: 'Pixie Curls', category: 'short', image: 'pixie-curls-icon.png', guide: 'bone-straight-guide.png', prompt: 'tight pixie curls jet black, 8k resolution, realistic texture, salon quality' }
    ];

    // --- State Management ---
    window.changeState = (newState, mode = null) => {
        document.querySelectorAll('.state-section').forEach(s => s.classList.remove('state-active'));
        document.getElementById(`state-${newState}`).classList.add('state-active');
        currentState = newState;
        
        // Show/Hide back button
        const navBack = document.getElementById('navBack');
        if (newState === 'landing') {
            navBack.classList.add('d-none');
        } else {
            navBack.classList.remove('d-none');
        }

        if (newState === 'capture' && mode) {
            setCaptureMode(mode);
        }
        
        if (newState === 'styling') {
            renderStylesGrid();
            if (styles.length > 0 && !selectedStyleId) {
                selectStyle(styles[0].id);
            }
        }
    };

    // --- Capture Logic ---
    function setCaptureMode(mode) {
        captureMode = mode;
        const cameraView = document.getElementById('cameraView');
        const uploadView = document.getElementById('uploadView');
        const btnToggle = document.getElementById('btnToggleMode');

        if (mode === 'camera') {
            cameraView.classList.remove('d-none');
            uploadView.classList.add('d-none');
            btnToggle.innerText = 'Switch to Upload';
            startCamera();
        } else {
            cameraView.classList.add('d-none');
            uploadView.classList.remove('d-none');
            btnToggle.innerText = 'Switch to Camera';
            stopCamera();
        }
    }

    window.toggleCaptureMode = () => {
        setCaptureMode(captureMode === 'camera' ? 'upload' : 'camera');
    };

    async function startCamera() {
        const video = document.getElementById('webcam');
        if (!video) return; // Guard for state changes
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
            video.srcObject = stream;
        } catch (err) {
            console.error("Camera access denied", err);
            alert("Camera access denied. Please use the upload option.");
            setCaptureMode('upload');
        }
    }

    function stopCamera() {
        const video = document.getElementById('webcam');
        if (video && video.srcObject) {
            video.srcObject.getTracks().forEach(track => track.stop());
            video.srcObject = null;
        }
    }

    window.capturePhoto = () => {
        const video = document.getElementById('webcam');
        const canvas = document.getElementById('captureCanvas');
        const ctx = canvas.getContext('2d');
        
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        
        // Draw mirrored for selfie look
        ctx.translate(canvas.width, 0);
        ctx.scale(-1, 1);
        ctx.drawImage(video, 0, 0);
        
        baseImageData = canvas.toDataURL('image/png');
        document.getElementById('baseImage').src = baseImageData;
        document.getElementById('processingImage').src = baseImageData;
        
        stopCamera();
        changeState('styling');
    };

    const fileInput = document.getElementById('fileInput');
    fileInput.onchange = (e) => {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = (event) => {
                baseImageData = event.target.result;
                document.getElementById('baseImage').src = baseImageData;
                document.getElementById('processingImage').src = baseImageData;
                changeState('styling');
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    };

    // --- Styling Logic ---
    function renderStylesGrid() {
        const grid = document.getElementById('stylesGrid');
        grid.innerHTML = styles.map(style => `
            <div class="style-item-card luxury-card p-3 mb-3 d-flex align-items-center gap-3 cursor-pointer ${selectedStyleId === style.id ? 'active' : ''}" onclick="selectStyle('${style.id}')">
                <img src="/img/${style.image}" class="rounded-circle object-fit-cover" style="width: 60px; height: 60px;">
                <div>
                    <h4 class="font-serif h6 mb-1">${style.name}</h4>
                    <span class="text-gold text-uppercase x-small tracking-widest">${style.category}</span>
                </div>
            </div>
        `).join('');
    }

    window.selectStyle = (id) => {
        selectedStyleId = id;
        renderStylesGrid();
        const style = styles.find(s => s.id === id);
        if (style) {
            document.getElementById('wigGuideImg').src = `/img/${style.guide}`;
        }
    };

    // Drag and Drop Wig Guide
    const wigGuide = document.getElementById('wigGuide');
    let isDragging = false;
    let startX, startY, initialTop, initialLeft;

    wigGuide.onmousedown = (e) => {
        isDragging = true;
        startX = e.clientX;
        startY = e.clientY;
        initialTop = wigGuide.offsetTop;
        initialLeft = wigGuide.offsetLeft;
        wigGuide.classList.add('cursor-grabbing');
    };

    window.onmousemove = (e) => {
        if (!isDragging) return;
        const dx = e.clientX - startX;
        const dy = e.clientY - startY;
        wigGuide.style.top = `${initialTop + dy}px`;
        wigGuide.style.left = `${initialLeft + dx}px`;
    };

    window.onmouseup = () => {
        isDragging = false;
        wigGuide.classList.remove('cursor-grabbing');
    };

    // Scale Logic
    const scaleRange = document.getElementById('scaleRange');
    const scaleLabel = document.getElementById('scaleLabel');
    scaleRange.oninput = (e) => {
        const val = e.target.value;
        wigGuide.style.transform = `scale(${val})`;
        scaleLabel.innerText = val;
    };

    // --- AI Transformation ---
    window.applyAITransformation = async () => {
        changeState('processing');
        
        let apiKey = window.localStorage.getItem('gemini_api_key');
        if (!apiKey) {
            apiKey = prompt("Please enter your Gemini API Key for high-fidelity transformation:");
            if (apiKey) window.localStorage.setItem('gemini_api_key', apiKey);
        }
        
        if (!apiKey) {
            alert("API Key required for transformation.");
            changeState('styling');
            return;
        }

        try {
            const genAI = new GoogleGenerativeAI(apiKey);
            const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
            const style = styles.find(s => s.id === selectedStyleId);

            const promptText = `PHOTO-REALISTIC TRANSFORMATION TASK:
            Apply this specific hairstyle to the person in the provided photo: ${style.prompt}.
            
            STRICT RULES:
            1. Keep the person's face identity, features, and skin tone 100% EXACTLY identical.
            2. Replace their current hair with the new style described.
            3. The new hair MUST blend perfectly with their natural forehead and temples.
            4. The final output must look like a real, unedited high-resolution photograph (8k UHD).
            
            OUTPUT FORMAT:
            Return ONLY a JSON object containing the base64 encoded image: {"image": "base64_string_here"}`;

            const result = await model.generateContent([
                promptText,
                {
                    inlineData: {
                        data: baseImageData.split(',')[1],
                        mimeType: "image/png"
                    }
                }
            ]);

            const response = await result.response;
            const text = response.text();
            const jsonStr = text.replace(/```json|```/g, '').trim();
            const json = JSON.parse(jsonStr);
            
            resultImageData = `data:image/png;base64,${json.image}`;
            document.getElementById('resultImage').src = resultImageData;
            document.getElementById('compareImage').src = baseImageData;
            
            renderResultStyles();
            changeState('result');
        } catch (err) {
            console.error("AI Error", err);
            alert("AI Transformation failed. Check your API key or connection.");
            changeState('styling');
        }
    };

    // --- Result Logic ---
    function renderResultStyles() {
        const list = document.getElementById('resultStylesList');
        list.innerHTML = styles.map(style => `
            <div class="luxury-card p-2 d-flex align-items-center gap-3 cursor-pointer ${selectedStyleId === style.id ? 'border-gold' : ''}" onclick="selectStyle('${style.id}'); applyAITransformation();">
                <img src="/img/${style.image}" class="rounded-3 object-fit-cover" style="width: 40px; height: 40px;">
                <span class="small fw-medium">${style.name}</span>
            </div>
        `).join('');
    }

    let isComparing = false;
    window.toggleCompare = () => {
        isComparing = !isComparing;
        const overlay = document.getElementById('compareOverlay');
        const btn = document.getElementById('btnCompare');
        
        if (isComparing) {
            overlay.classList.remove('d-none');
            btn.classList.add('bg-dark', 'text-white');
        } else {
            overlay.classList.add('d-none');
            btn.classList.remove('bg-dark', 'text-white');
        }
    };

    window.downloadResult = () => {
        const link = document.createElement('a');
        link.download = `HairAura_Look_${selectedStyleId}.png`;
        link.href = resultImageData;
        link.click();
    };
});
</script>
