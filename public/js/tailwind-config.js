tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "surface-container-high": "var(--color-surface-container-high)",
                "inverse-surface": "var(--color-inverse-surface)",
                "secondary-fixed": "var(--color-secondary-fixed)",
                "surface": "var(--color-surface)",
                "primary-fixed-dim": "var(--color-primary-fixed-dim)",
                "error-container": "var(--color-error-container)",
                "secondary-container": "var(--color-secondary-container)",
                "on-secondary-container": "var(--color-on-secondary-container)",
                "error": "var(--color-error)",
                "on-tertiary-container": "var(--color-on-tertiary-container)",
                "surface-container-lowest": "var(--color-surface-container-lowest)",
                "on-secondary-fixed": "var(--color-on-secondary-fixed)",
                "on-primary": "var(--color-on-primary)",
                "on-error-container": "var(--color-on-error-container)",
                "on-primary-container": "var(--color-on-primary-container)",
                "tertiary-container": "var(--color-tertiary-container)",
                "on-tertiary-fixed": "var(--color-on-tertiary-fixed)",
                "surface-dim": "var(--color-surface-dim)",
                "on-secondary-fixed-variant": "var(--color-on-secondary-fixed-variant)",
                "primary": "var(--color-primary)",
                "primary-container": "var(--color-primary-container)",
                "tertiary-fixed-dim": "var(--color-tertiary-fixed-dim)",
                "on-surface": "var(--color-on-surface)",
                "tertiary-fixed": "var(--color-tertiary-fixed)",
                "secondary": "var(--color-secondary)",
                "surface-container-low": "var(--color-surface-container-low)",
                "on-secondary": "var(--color-on-secondary)",
                "inverse-primary": "var(--color-inverse-primary)",
                "surface-container": "var(--color-surface-container)",
                "inverse-on-surface": "var(--color-inverse-on-surface)",
                "on-primary-fixed-variant": "var(--color-on-primary-fixed-variant)",
                "background": "var(--color-background)",
                "surface-tint": "var(--color-surface-tint)",
                "surface-container-highest": "var(--color-surface-container-highest)",
                "on-tertiary": "var(--color-on-tertiary)",
                "surface-variant": "var(--color-surface-variant)",
                "on-background": "var(--color-on-background)",
                "on-surface-variant": "var(--color-on-surface-variant)",
                "on-primary-fixed": "var(--color-on-primary-fixed)",
                "surface-bright": "var(--color-surface-bright)",
                "outline-variant": "var(--color-outline-variant)",
                "secondary-fixed-dim": "var(--color-secondary-fixed-dim)",
                "outline": "var(--color-outline)",
                "on-tertiary-fixed-variant": "var(--color-on-tertiary-fixed-variant)",
                "on-error": "var(--color-on-error)",
                "primary-fixed": "var(--color-primary-fixed)",
                "tertiary": "var(--color-tertiary)"
            },
            borderRadius: {
                "DEFAULT": "1rem",
                "lg": "2rem",
                "xl": "3rem",
                "full": "9999px"
            },
            spacing: {
                "unit": "8px",
                "container-padding": "40px",
                "organic-offset": "24px",
                "section-gap": "80px"
            },
            fontFamily: {
                "body-md": ["Inter"],
                "title-lg": ["Inter"],
                "body-lg": ["Inter"],
                "display-lg": ["Bodoni Moda"],
                "headline-lg-mobile": ["Bodoni Moda"],
                "label-caps": ["Inter"],
                "headline-lg": ["Bodoni Moda"],
                "display-md": ["Bodoni Moda"]
            },
            fontSize: {
                "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                "title-lg": ["20px", { "lineHeight": "28px", "letterSpacing": "0.01em", "fontWeight": "600" }],
                "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                "display-lg": ["64px", { "lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "600" }],
                "headline-lg-mobile": ["28px", { "lineHeight": "1.3", "fontWeight": "500" }],
                "label-caps": ["12px", { "lineHeight": "16px", "letterSpacing": "0.1em", "fontWeight": "700" }],
                "headline-lg": ["32px", { "lineHeight": "1.3", "fontWeight": "500" }],
                "display-md": ["48px", { "lineHeight": "1.2", "letterSpacing": "-0.01em", "fontWeight": "500" }]
            }
        }
    }
};
