import { GoogleGenAI } from "@google/genai";

export interface HairStyle {
  id: string;
  name: string;
  category: 'long' | 'short' | 'curly' | 'straight' | 'updo';
  description: string;
  prompt: string;
  thumbnail: string;
  overlayUrl: string; // Transparent PNG for manual adjustment
}

export const HAIR_STYLES: HairStyle[] = [
  // LONG
  {
    id: "long-blonde-waves",
    name: "Golden Waves",
    category: 'long',
    description: "Long, flowing blonde hair with soft beach waves.",
    prompt: "long blonde hair with soft beach waves, highly realistic, professional salon style, perfectly blended with the face",
    thumbnail: "https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?auto=format&fit=crop&q=80&w=200&h=200",
    overlayUrl: "https://i.ibb.co/v4vYVzK/long-blonde.png"
  },
  {
    id: "long-straight-raven",
    name: "Raven Silk",
    category: 'long',
    description: "Ultra-long, bone-straight jet black hair.",
    prompt: "ultra-long straight jet black hair, high shine, silk texture, professional salon look, perfectly blended with the face",
    thumbnail: "https://images.unsplash.com/photo-1534450607746-89033094e7bd?auto=format&fit=crop&q=80&w=200&h=200",
    overlayUrl: "https://i.ibb.co/mS6X6n0/long-black.png"
  },
  // SHORT
  {
    id: "sleek-black-bob",
    name: "Midnight Bob",
    category: 'short',
    description: "A sharp, chin-length sleek black bob.",
    prompt: "sleek chin-length black bob haircut, straight hair, high shine, professional salon look, perfectly blended with the face",
    thumbnail: "https://images.unsplash.com/photo-1516914915600-240abe82583e?auto=format&fit=crop&q=80&w=200&h=200",
    overlayUrl: "https://i.ibb.co/0Y4YVzK/bob.png"
  },
  {
    id: "platinum-pixie",
    name: "Platinum Pixie",
    category: 'short',
    description: "Edgy platinum blonde pixie cut.",
    prompt: "edgy platinum blonde pixie haircut, short textured hair, modern style, professional salon look, perfectly blended with the face",
    thumbnail: "https://images.unsplash.com/photo-1605497788044-5a32c7078486?auto=format&fit=crop&q=80&w=200&h=200",
    overlayUrl: "https://i.ibb.co/v4vYVzK/pixie.png"
  },
  // CURLY
  {
    id: "auburn-curls",
    name: "Auburn Curls",
    category: 'curly',
    description: "Voluminous, bouncy auburn curls.",
    prompt: "voluminous bouncy auburn curly hair, rich copper tones, natural texture, professional salon style, perfectly blended with the face",
    thumbnail: "https://images.unsplash.com/photo-1580618672591-eb180b1a973f?auto=format&fit=crop&q=80&w=200&h=200",
    overlayUrl: "https://i.ibb.co/mS6X6n0/curls.png"
  },
  {
    id: "honey-ringlets",
    name: "Honey Ringlets",
    category: 'curly',
    description: "Tight, defined honey-blonde ringlets.",
    prompt: "tight defined honey-blonde ringlets, curly hair, natural texture, professional salon style, perfectly blended with the face",
    thumbnail: "https://images.unsplash.com/photo-1574621100236-d25b64cfd647?auto=format&fit=crop&q=80&w=200&h=200",
    overlayUrl: "https://i.ibb.co/0Y4YVzK/ringlets.png"
  },
  // STRAIGHT
  {
    id: "caramel-layers",
    name: "Caramel Layers",
    category: 'straight',
    description: "Medium-length straight hair with caramel highlights.",
    prompt: "medium-length straight hair with caramel highlights and face-framing layers, professional salon look, perfectly blended with the face",
    thumbnail: "https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&q=80&w=200&h=200",
    overlayUrl: "https://i.ibb.co/v4vYVzK/layers.png"
  },
  // UPDOS
  {
    id: "elegant-chignon",
    name: "Royal Chignon",
    category: 'updo',
    description: "A sophisticated, low-tucked chignon.",
    prompt: "sophisticated low-tucked chignon updo, elegant bridal hairstyle, smooth finish, professional salon look, perfectly blended with the face",
    thumbnail: "https://images.unsplash.com/photo-1519699047748-de8e457a634e?auto=format&fit=crop&q=80&w=200&h=200",
    overlayUrl: "https://i.ibb.co/mS6X6n0/updo.png"
  },
  {
    id: "boho-braid-crown",
    name: "Boho Crown",
    category: 'updo',
    description: "Intricate braided crown with loose tendrils.",
    prompt: "intricate braided crown hairstyle, bohemian style, loose tendrils, romantic look, professional salon style, perfectly blended with the face",
    thumbnail: "https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&q=80&w=200&h=200",
    overlayUrl: "https://i.ibb.co/0Y4YVzK/braid.png"
  }
];

export async function tryOnHair(base64Image: string, style: HairStyle): Promise<string | null> {
  try {
    const ai = new GoogleGenAI({ apiKey: process.env.GEMINI_API_KEY });
    const response = await ai.models.generateContent({
      model: 'gemini-2.5-flash-image',
      contents: {
        parts: [
          {
            inlineData: {
              data: base64Image.split(',')[1],
              mimeType: 'image/png',
            },
          },
          {
            text: `Apply this hairstyle to the person in the image: ${style.prompt}. Keep the person's face and features identical, only change the hair. The hair should look like a high-quality wig or professional salon styling that is perfectly blended with their natural hairline and face shape. Return only the edited image.`,
          },
        ],
      },
    });

    for (const part of response.candidates[0].content.parts) {
      if (part.inlineData) {
        return `data:image/png;base64,${part.inlineData.data}`;
      }
    }
    return null;
  } catch (error) {
    console.error("Error in tryOnHair:", error);
    return null;
  }
}
