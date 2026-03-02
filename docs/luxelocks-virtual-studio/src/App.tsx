import React, { useState, useRef, useCallback } from 'react';
import { useDropzone } from 'react-dropzone';
import { motion, AnimatePresence } from 'motion/react';
import { Camera, Upload, RefreshCw, Download, ChevronLeft, Sparkles, User, CameraOff, Scissors, Maximize, Move, Check } from 'lucide-react';
import confetti from 'canvas-confetti';
import { HAIR_STYLES, tryOnHair, HairStyle } from './services/geminiService';

type AppState = 'landing' | 'capture' | 'styling' | 'processing' | 'result';

export default function App() {
  const [state, setState] = useState<AppState>('landing');
  const [mode, setMode] = useState<'camera' | 'upload'>('camera');
  const [originalImage, setOriginalImage] = useState<string | null>(null);
  const [resultImage, setResultImage] = useState<string | null>(null);
  const [selectedStyle, setSelectedStyle] = useState<HairStyle>(HAIR_STYLES[0]);
  const [activeCategory, setActiveCategory] = useState<string>('all');
  const [isCameraActive, setIsCameraActive] = useState(false);
  const [error, setError] = useState<string | null>(null);

  // Styling state
  const [hairScale, setHairScale] = useState(1);

  const videoRef = useRef<HTMLVideoElement>(null);
  const canvasRef = useRef<HTMLCanvasElement>(null);
  const containerRef = useRef<HTMLDivElement>(null);

  // --- Camera Logic ---
  const startCamera = async () => {
    try {
      const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
      if (videoRef.current) {
        videoRef.current.srcObject = stream;
        setIsCameraActive(true);
        setError(null);
      }
    } catch (err) {
      console.error("Error accessing camera:", err);
      setError("Unable to access camera. Please check permissions.");
    }
  };

  const stopCamera = () => {
    if (videoRef.current && videoRef.current.srcObject) {
      const stream = videoRef.current.srcObject as MediaStream;
      stream.getTracks().forEach(track => track.stop());
      setIsCameraActive(false);
    }
  };

  const capturePhoto = () => {
    if (videoRef.current && canvasRef.current) {
      const video = videoRef.current;
      const canvas = canvasRef.current;
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      const ctx = canvas.getContext('2d');
      if (ctx) {
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        const dataUrl = canvas.toDataURL('image/png');
        setOriginalImage(dataUrl);
        stopCamera();
        setState('styling');
      }
    }
  };

  // --- Upload Logic ---
  const onDrop = useCallback((acceptedFiles: File[]) => {
    const file = acceptedFiles[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = () => {
      const dataUrl = reader.result as string;
      setOriginalImage(dataUrl);
      setState('styling');
    };
    reader.readAsDataURL(file);
  }, []);

  const { getRootProps, getInputProps, isDragActive } = useDropzone({ 
    onDrop, 
    accept: { 'image/*': [] as string[] },
    multiple: false 
  } as any);

  // --- AI Logic ---
  const handleTryOn = async () => {
    if (!originalImage) return;
    setState('processing');
    setError(null);
    
    // The AI handles the blending. The manual adjustment is a guide for the user.
    const result = await tryOnHair(originalImage, selectedStyle);
    
    if (result) {
      setResultImage(result);
      setState('result');
      confetti({
        particleCount: 150,
        spread: 70,
        origin: { y: 0.6 },
        colors: ['#D4AF37', '#F5F2ED', '#1A1A1A']
      });
    } else {
      setError("AI processing failed. Please try again.");
      setState('styling');
    }
  };

  // --- Navigation ---
  const reset = () => {
    stopCamera();
    setState('landing');
    setOriginalImage(null);
    setResultImage(null);
    setError(null);
    setHairScale(1);
  };

  const categories = ['all', 'long', 'short', 'curly', 'straight', 'updo'];
  const filteredStyles = activeCategory === 'all' 
    ? HAIR_STYLES 
    : HAIR_STYLES.filter(s => s.category === activeCategory);

  return (
    <div className="min-h-screen flex flex-col">
      {/* Header */}
      <header className="p-6 flex justify-between items-center z-50">
        <div className="flex items-center gap-2 cursor-pointer" onClick={reset}>
          <div className="w-10 h-10 bg-onyx rounded-full flex items-center justify-center">
            <Scissors className="text-gold w-5 h-5" />
          </div>
          <h1 className="font-serif text-2xl font-bold tracking-tight">LUXELOCKS</h1>
        </div>
        
        {state !== 'landing' && (
          <button 
            onClick={reset}
            className="flex items-center gap-2 text-sm font-medium hover:text-gold transition-colors"
          >
            <ChevronLeft className="w-4 h-4" />
            Back to Home
          </button>
        )}
      </header>

      <main className="flex-1 flex flex-col items-center justify-center px-6 pb-12">
        <AnimatePresence mode="wait">
          {state === 'landing' && (
            <motion.div 
              key="landing"
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              exit={{ opacity: 0, y: -20 }}
              className="max-w-4xl w-full text-center space-y-12"
            >
              <div className="space-y-4">
                <motion.span 
                  initial={{ opacity: 0 }}
                  animate={{ opacity: 1 }}
                  transition={{ delay: 0.2 }}
                  className="text-xs uppercase tracking-[0.3em] font-semibold text-gold"
                >
                  The Future of Hair Styling
                </motion.span>
                <h2 className="text-6xl md:text-8xl font-serif font-light leading-tight">
                  Find your <span className="italic">perfect</span> look.
                </h2>
                <p className="text-lg text-onyx/60 max-w-2xl mx-auto font-light">
                  Experience professional hair transformations instantly with our AI-powered virtual studio. 
                  Try on premium wigs and styles with studio-quality realism.
                </p>
              </div>

              <div className="flex flex-col md:flex-row gap-6 justify-center items-center">
                <button 
                  onClick={() => { setMode('camera'); setState('capture'); startCamera(); }}
                  className="gold-button flex items-center gap-3 w-full md:w-auto justify-center"
                >
                  <Camera className="w-5 h-5" />
                  Live Mirror
                </button>
                <button 
                  onClick={() => { setMode('upload'); setState('capture'); }}
                  className="bg-white text-onyx border border-onyx/10 px-8 py-3 rounded-full font-medium tracking-wide hover:bg-onyx/5 transition-all w-full md:w-auto justify-center flex items-center gap-3"
                >
                  <Upload className="w-5 h-5" />
                  Upload Photo
                </button>
              </div>

              <div className="pt-12 grid grid-cols-2 md:grid-cols-4 gap-4 opacity-40 grayscale hover:grayscale-0 transition-all duration-700">
                {HAIR_STYLES.slice(0, 4).map(style => (
                  <img 
                    key={style.id} 
                    src={style.thumbnail} 
                    alt={style.name} 
                    className="w-full aspect-square object-cover rounded-2xl"
                    referrerPolicy="no-referrer"
                  />
                ))}
              </div>
            </motion.div>
          )}

          {state === 'capture' && (
            <motion.div 
              key="capture"
              initial={{ opacity: 0, scale: 0.95 }}
              animate={{ opacity: 1, scale: 1 }}
              exit={{ opacity: 0, scale: 1.05 }}
              className="w-full max-w-2xl space-y-8"
            >
              <div className="luxury-card aspect-[3/4] relative flex flex-col items-center justify-center bg-black">
                {mode === 'camera' ? (
                  <>
                    <video 
                      ref={videoRef} 
                      autoPlay 
                      playsInline 
                      className="w-full h-full object-cover"
                    />
                    {!isCameraActive && !error && (
                      <div className="absolute inset-0 flex flex-col items-center justify-center text-cream space-y-4">
                        <RefreshCw className="w-8 h-8 animate-spin text-gold" />
                        <p className="text-sm font-light">Initializing camera...</p>
                      </div>
                    )}
                    {error && (
                      <div className="absolute inset-0 flex flex-col items-center justify-center text-cream p-8 text-center space-y-4">
                        <CameraOff className="w-12 h-12 text-red-400" />
                        <p className="text-sm font-light">{error}</p>
                        <button onClick={startCamera} className="text-gold underline">Try again</button>
                      </div>
                    )}
                    <div className="absolute bottom-8 left-0 right-0 flex justify-center">
                      <button 
                        onClick={capturePhoto}
                        disabled={!isCameraActive}
                        className="w-20 h-20 rounded-full border-4 border-white flex items-center justify-center hover:scale-110 transition-transform active:scale-90 disabled:opacity-50"
                      >
                        <div className="w-16 h-16 bg-white rounded-full" />
                      </button>
                    </div>
                  </>
                ) : (
                  <div 
                    {...getRootProps()} 
                    className={`w-full h-full flex flex-col items-center justify-center p-12 text-center cursor-pointer transition-colors ${isDragActive ? 'bg-gold/10' : ''}`}
                  >
                    <input {...getInputProps()} />
                    <div className="w-20 h-20 bg-cream rounded-full flex items-center justify-center mb-6">
                      <Upload className="text-onyx w-8 h-8" />
                    </div>
                    <h3 className="text-2xl font-serif mb-2 text-cream">Drop your portrait here</h3>
                    <p className="text-cream/60 font-light">or click to browse from your device</p>
                    <p className="mt-8 text-xs text-gold uppercase tracking-widest">Best results with clear front-facing photos</p>
                  </div>
                )}
              </div>
              
              <div className="flex justify-between items-center text-sm font-medium">
                <p className="text-onyx/40">Step 1: Capture or Upload your photo</p>
                <button onClick={() => setMode(mode === 'camera' ? 'upload' : 'camera')} className="text-gold hover:underline">
                  Switch to {mode === 'camera' ? 'Upload' : 'Camera'}
                </button>
              </div>
            </motion.div>
          )}

          {state === 'styling' && (
            <motion.div 
              key="styling"
              initial={{ opacity: 0 }}
              animate={{ opacity: 1 }}
              className="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-12 gap-12 items-start"
            >
              {/* Adjustment Area */}
              <div className="lg:col-span-7 space-y-6">
                <div 
                  ref={containerRef}
                  className="luxury-card aspect-[3/4] relative bg-onyx overflow-hidden cursor-crosshair"
                >
                  <img 
                    src={originalImage!} 
                    alt="Original" 
                    className="w-full h-full object-cover opacity-80"
                    referrerPolicy="no-referrer"
                  />
                  
                  {/* Hair Overlay */}
                  <motion.div
                    drag
                    dragConstraints={containerRef}
                    style={{ 
                      scale: hairScale,
                      position: 'absolute',
                      top: '20%',
                      left: '25%',
                      width: '50%',
                      zIndex: 20
                    }}
                    className="cursor-grab active:cursor-grabbing"
                  >
                    <img 
                      src={selectedStyle.thumbnail} 
                      alt="Hair Guide" 
                      className="w-full h-auto opacity-70 mix-blend-screen pointer-events-none"
                      referrerPolicy="no-referrer"
                    />
                    <div className="absolute inset-0 border-2 border-gold/30 rounded-lg pointer-events-none" />
                  </motion.div>

                  <div className="absolute bottom-6 left-6 right-6 flex justify-between items-center pointer-events-none">
                    <div className="glass-panel px-4 py-2 rounded-full text-[10px] uppercase tracking-widest flex items-center gap-2 pointer-events-auto">
                      <Move className="w-3 h-3 text-gold" />
                      Drag to Position
                    </div>
                    <div className="glass-panel px-4 py-2 rounded-full text-[10px] uppercase tracking-widest flex items-center gap-2 pointer-events-auto">
                      <Maximize className="w-3 h-3 text-gold" />
                      Scale: {hairScale.toFixed(1)}x
                    </div>
                  </div>
                </div>

                <div className="space-y-4">
                  <div className="flex items-center gap-4">
                    <Maximize className="w-4 h-4 text-onyx/40" />
                    <input 
                      type="range" 
                      min="0.5" 
                      max="2" 
                      step="0.1" 
                      value={hairScale}
                      onChange={(e) => setHairScale(parseFloat(e.target.value))}
                      className="flex-1 accent-gold"
                    />
                  </div>
                  <button 
                    onClick={handleTryOn}
                    className="w-full gold-button flex items-center justify-center gap-3"
                  >
                    <Sparkles className="w-5 h-5" />
                    Apply AI Transformation
                  </button>
                </div>
              </div>

              {/* Library Sidebar */}
              <div className="lg:col-span-5 space-y-8">
                <div className="space-y-4">
                  <h3 className="text-3xl font-serif">Select Style</h3>
                  
                  {/* Categories */}
                  <div className="flex flex-wrap gap-2">
                    {categories.map(cat => (
                      <button
                        key={cat}
                        onClick={() => setActiveCategory(cat)}
                        className={`px-4 py-1.5 rounded-full text-[10px] uppercase tracking-widest font-semibold transition-all border ${
                          activeCategory === cat 
                            ? 'bg-onyx text-cream border-onyx' 
                            : 'bg-white text-onyx/40 border-black/5 hover:border-onyx/20'
                        }`}
                      >
                        {cat}
                      </button>
                    ))}
                  </div>
                </div>

                <div className="grid grid-cols-1 gap-3 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                  {filteredStyles.map(style => (
                    <button
                      key={style.id}
                      onClick={() => setSelectedStyle(style)}
                      className={`flex items-center gap-4 p-3 rounded-2xl border transition-all text-left ${
                        selectedStyle.id === style.id 
                          ? 'border-gold bg-gold/5 shadow-lg shadow-gold/5' 
                          : 'border-black/5 hover:border-black/20 bg-white'
                      }`}
                    >
                      <img 
                        src={style.thumbnail} 
                        alt={style.name} 
                        className="w-14 h-14 rounded-xl object-cover"
                        referrerPolicy="no-referrer"
                      />
                      <div className="flex-1">
                        <h4 className="text-sm font-medium">{style.name}</h4>
                        <p className="text-[10px] text-onyx/50 line-clamp-1 uppercase tracking-wider">{style.category}</p>
                      </div>
                      {selectedStyle.id === style.id && (
                        <Check className="w-4 h-4 text-gold" />
                      )}
                    </button>
                  ))}
                </div>
              </div>
            </motion.div>
          )}

          {state === 'processing' && (
            <motion.div 
              key="processing"
              initial={{ opacity: 0 }}
              animate={{ opacity: 1 }}
              className="flex flex-col items-center space-y-8"
            >
              <div className="relative w-64 h-64">
                <motion.div 
                  animate={{ rotate: 360 }}
                  transition={{ duration: 4, repeat: Infinity, ease: "linear" }}
                  className="absolute inset-0 border-t-2 border-gold rounded-full"
                />
                <div className="absolute inset-4 rounded-full overflow-hidden grayscale opacity-50">
                  <img src={originalImage!} alt="Original" className="w-full h-full object-cover" referrerPolicy="no-referrer" />
                </div>
                <div className="absolute inset-0 flex items-center justify-center">
                  <Sparkles className="w-8 h-8 text-gold animate-pulse" />
                </div>
              </div>
              <div className="text-center space-y-2">
                <h3 className="text-2xl font-serif">Crafting your look...</h3>
                <p className="text-onyx/60 font-light">Our AI is blending the <span className="text-onyx font-medium">{selectedStyle.name}</span> style with your features.</p>
              </div>
            </motion.div>
          )}

          {state === 'result' && (
            <motion.div 
              key="result"
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              className="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-12 gap-12 items-start"
            >
              {/* Main Result Display */}
              <div className="lg:col-span-7 space-y-6">
                <div className="luxury-card aspect-[3/4] relative bg-onyx">
                  <img 
                    src={resultImage!} 
                    alt="Result" 
                    className="w-full h-full object-cover"
                    referrerPolicy="no-referrer"
                  />
                  <div className="absolute top-6 left-6 flex gap-2">
                    <div className="glass-panel px-4 py-2 rounded-full text-xs font-semibold uppercase tracking-widest flex items-center gap-2">
                      <Sparkles className="w-3 h-3 text-gold" />
                      AI Enhanced
                    </div>
                  </div>
                </div>
                
                <div className="flex gap-4">
                  <button 
                    onClick={() => {
                      const link = document.createElement('a');
                      link.href = resultImage!;
                      link.download = `luxelocks-${selectedStyle.id}.png`;
                      link.click();
                    }}
                    className="flex-1 gold-button flex items-center justify-center gap-2"
                  >
                    <Download className="w-5 h-5" />
                    Save Look
                  </button>
                  <button 
                    onClick={() => { setState('capture'); startCamera(); }}
                    className="px-6 py-3 rounded-full border border-onyx/10 hover:bg-onyx/5 transition-all"
                  >
                    <RefreshCw className="w-5 h-5" />
                  </button>
                </div>
              </div>

              {/* Style Sidebar */}
              <div className="lg:col-span-5 space-y-8">
                <div className="space-y-2">
                  <h3 className="text-3xl font-serif">Try another style</h3>
                  <p className="text-onyx/60 font-light">Select a different hairstyle to see it instantly.</p>
                </div>

                <div className="grid grid-cols-1 gap-4">
                  {HAIR_STYLES.slice(0, 5).map(style => (
                    <button
                      key={style.id}
                      onClick={() => { setSelectedStyle(style); handleTryOn(); }}
                      className={`flex items-center gap-4 p-4 rounded-2xl border transition-all text-left ${
                        selectedStyle.id === style.id 
                          ? 'border-gold bg-gold/5 shadow-lg shadow-gold/5' 
                          : 'border-black/5 hover:border-black/20 bg-white'
                      }`}
                    >
                      <img 
                        src={style.thumbnail} 
                        alt={style.name} 
                        className="w-16 h-16 rounded-xl object-cover"
                        referrerPolicy="no-referrer"
                      />
                      <div className="flex-1">
                        <h4 className="font-medium">{style.name}</h4>
                        <p className="text-xs text-onyx/50 line-clamp-1">{style.description}</p>
                      </div>
                      {selectedStyle.id === style.id && (
                        <div className="w-6 h-6 bg-gold rounded-full flex items-center justify-center">
                          <Sparkles className="w-3 h-3 text-onyx" />
                        </div>
                      )}
                    </button>
                  ))}
                </div>

                <div className="p-6 bg-onyx text-cream rounded-3xl space-y-4">
                  <div className="flex items-center gap-3">
                    <div className="w-10 h-10 rounded-full bg-gold/20 flex items-center justify-center">
                      <User className="text-gold w-5 h-5" />
                    </div>
                    <div>
                      <h4 className="font-serif text-lg">Style Consultation</h4>
                      <p className="text-xs text-cream/50 uppercase tracking-widest">Expert Tip</p>
                    </div>
                  </div>
                  <p className="text-sm font-light leading-relaxed text-cream/80">
                    The <span className="text-gold font-medium">{selectedStyle.name}</span> complements your face shape beautifully. 
                    This style works best with high-contrast makeup and minimalist accessories.
                  </p>
                </div>
              </div>
            </motion.div>
          )}
        </AnimatePresence>
      </main>

      {/* Footer */}
      <footer className="p-8 border-t border-black/5 flex flex-col md:flex-row justify-between items-center gap-6 text-xs uppercase tracking-[0.2em] font-medium text-onyx/40">
        <div className="flex gap-8">
          <span>Privacy</span>
          <span>Terms</span>
          <span>Contact</span>
        </div>
        <div className="text-center">
          © 2026 LUXELOCKS VIRTUAL STUDIO • POWERED BY GEMINI AI
        </div>
        <div className="flex gap-4">
          <div className="w-8 h-8 rounded-full border border-black/10 flex items-center justify-center hover:border-gold hover:text-gold transition-colors cursor-pointer">IG</div>
          <div className="w-8 h-8 rounded-full border border-black/10 flex items-center justify-center hover:border-gold hover:text-gold transition-colors cursor-pointer">TW</div>
        </div>
      </footer>

      {/* Hidden Canvas for Photo Capture */}
      <canvas ref={canvasRef} className="hidden" />
    </div>
  );
}
