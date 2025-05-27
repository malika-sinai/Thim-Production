export default {
    data() {
        return {
            name: '',
            email: '',
            message: '',
            success: false,
            error: null,
            loading: false
        };
    },
    methods: {
        validateEmail(email) {
            // Validation simple de l'email
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        },
        async submitForm() {
            this.error = null;
            this.success = false;

            // Validation des champs
            if (!this.name || !this.email || !this.message) {
                this.error = "Tous les champs sont obligatoires.";
                return;
            }
            if (!this.validateEmail(this.email)) {
                this.error = "L'adresse email n'est pas valide.";
                return;
            }

            this.loading = true;
            try {
                const response = await fetch('/api/contact', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: this.name,
                        email: this.email,
                        message: this.message
                    })
                });
                if (!response.ok) {
                    const data = await response.json().catch(() => ({}));
                    throw new Error(data.message || "Erreur lors de l'envoi.");
                }
                this.success = true;
                this.name = '';
                this.email = '';
                this.message = '';
            } catch (err) {
                this.error = err.message || "Une erreur est survenue.";
            } finally {
                this.loading = false;
            }
        }
    }
};