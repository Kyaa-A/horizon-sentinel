# Horizon Sentinel Theme Guide

This document provides a comprehensive guide to the Horizon Sentinel design system and theme.

## Overview

The Horizon Sentinel theme is built on Tailwind CSS with a custom color palette inspired by horizons, skies, and modern design principles. The theme emphasizes:

- **Modern gradients** (blue → purple → teal)
- **Smooth animations** and transitions
- **Dark mode support**
- **Accessibility** and responsive design
- **Consistent spacing** and typography

## Color Palette

### Primary Colors (Blue)
The primary color represents trust, stability, and the horizon.

```html
<!-- Usage examples -->
<div class="bg-primary-500 text-white">Primary</div>
<div class="text-primary-600">Primary Text</div>
<div class="border-primary-300">Primary Border</div>
```

**Available shades:** `primary-50` through `primary-950`

### Secondary Colors (Purple)
The secondary color adds depth and creativity.

```html
<div class="bg-secondary-500 text-white">Secondary</div>
<div class="text-secondary-600">Secondary Text</div>
```

**Available shades:** `secondary-50` through `secondary-950`

### Accent Colors (Teal)
The accent color provides highlights and call-to-action elements.

```html
<div class="bg-accent-500 text-white">Accent</div>
<div class="text-accent-600">Accent Text</div>
```

**Available shades:** `accent-50` through `accent-950`

### Horizon Colors
Quick access to common horizon-themed colors.

```html
<div class="bg-horizon-light">Light Horizon</div>
<div class="bg-horizon">Default Horizon</div>
<div class="bg-horizon-dark">Dark Horizon</div>
```

## Gradients

### Main Gradient
The signature Horizon Sentinel gradient (blue → purple → teal).

```html
<div class="bg-gradient-horizon text-white">
  Horizon Gradient
</div>
```

### Soft Gradient
A subtle, light version for backgrounds.

```html
<div class="bg-gradient-horizon-soft">
  Soft Gradient Background
</div>
```

### Radial Gradient
A radial version for special effects.

```html
<div class="bg-gradient-radial text-white">
  Radial Gradient
</div>
```

## Shadows

### Horizon Shadow
A soft shadow with a blue tint.

```html
<div class="shadow-horizon">Card with Horizon Shadow</div>
```

### Large Horizon Shadow
A more pronounced shadow for elevated elements.

```html
<div class="shadow-horizon-lg">Elevated Card</div>
```

### Glow Effect
A glowing shadow effect.

```html
<div class="shadow-glow">Glowing Element</div>
```

## Animations

### Fade In
Smooth fade-in animation.

```html
<div class="animate-fade-in">Fades in</div>
```

### Slide Up
Slide up with fade-in animation.

```html
<div class="animate-slide-up">Slides up</div>
```

### Slow Pulse
A slow, gentle pulse animation.

```html
<div class="animate-pulse-slow">Slowly pulsing</div>
```

## Components

### Buttons

#### Primary Button
The main call-to-action button with gradient background.

```html
<x-primary-button>
    Click Me
</x-primary-button>
```

#### Secondary Button
A secondary action button with outlined style.

```html
<x-secondary-button>
    Cancel
</x-secondary-button>
```

### Form Inputs

#### Text Input
Styled text input with focus states.

```html
<x-text-input 
    type="email" 
    name="email" 
    placeholder="Enter email"
/>
```

#### Input Label
Consistent label styling.

```html
<x-input-label for="email" :value="__('Email Address')" />
```

## Layout Patterns

### Guest Layout
The guest layout includes:
- Animated background blobs
- Centered content card
- Logo and branding
- Glassmorphism effects

Used for authentication pages (login, register, password reset).

### App Layout
The main application layout with navigation and content areas.

## Best Practices

### 1. Color Usage
- Use `primary-*` for main actions and important elements
- Use `secondary-*` for secondary actions and accents
- Use `accent-*` for highlights and special callouts
- Maintain sufficient contrast for accessibility

### 2. Spacing
- Use consistent spacing scale (Tailwind's default)
- Prefer `space-y-*` for vertical spacing in forms
- Use `gap-*` for flex/grid layouts

### 3. Typography
- Use `font-semibold` for labels and headings
- Maintain readable font sizes (minimum 14px for body text)
- Use gradient text for branding: `bg-gradient-horizon bg-clip-text text-transparent`

### 4. Dark Mode
- Always test in both light and dark modes
- Use `dark:` prefix for dark mode variants
- Ensure sufficient contrast in both modes

### 5. Animations
- Use animations sparingly for important interactions
- Prefer `transition-all duration-200` for smooth transitions
- Use `active:scale-[0.98]` for button press feedback

## Example: Creating a New Page

```blade
<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-horizon p-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                Page Title
            </h1>
            
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Page description
            </p>
            
            <x-primary-button>
                Primary Action
            </x-primary-button>
        </div>
    </div>
</x-app-layout>
```

## Customization

### Extending Colors
To add new colors, edit `tailwind.config.js`:

```javascript
colors: {
    // ... existing colors
    custom: {
        500: '#your-color',
        // ... other shades
    },
}
```

### Adding Animations
Add custom animations in `tailwind.config.js`:

```javascript
keyframes: {
    yourAnimation: {
        '0%': { /* ... */ },
        '100%': { /* ... */ },
    },
},
animation: {
    'your-animation': 'yourAnimation 0.5s ease-in-out',
}
```

## Resources

- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Design Tokens Reference](tailwind.config.js)
- Component examples in `resources/views/components/`

## Support

For questions or suggestions about the theme, please refer to the project documentation or contact the development team.

