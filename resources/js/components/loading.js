function loadingScreen() {
    return {
        show: false,
        loadingCount: 0,
        timeoutId: null,
        shownAt: null,
        minDisplayTime: 200,

        init() {
            this.showLoader();

            this.initLivewireLoading();
            this.initNavigationLoading();

            window.addEventListener('load', () => {
                setTimeout(() => this.hideLoader(), 300);
            });
        },

        initLivewireLoading() {
            if (typeof Livewire !== 'undefined') {
                Livewire.hook('request', () => {
                    this.showLoader();
                });

                Livewire.hook('message.received', () => {
                    this.hideLoader();
                });

                Livewire.hook('message.failed', () => {
                    this.hideLoader();
                });
            }
        },

        initNavigationLoading() {
            document.addEventListener('livewire:navigating', () => {
                this.showLoader();
            });

            document.addEventListener('livewire:navigated', () => {
                this.hideLoader();
            });
        },

        showLoader() {
            this.loadingCount++;

            if (!this.show) {
                this.show = true;
                this.shownAt = Date.now();
                document.body.style.overflow = 'hidden';
            }

            if (this.timeoutId) {
                clearTimeout(this.timeoutId);
                this.timeoutId = null;
            }
        },

        hideLoader() {
            this.loadingCount--;

            if (this.loadingCount > 0) return;
            this.loadingCount = 0;

            const elapsed = Date.now() - (this.shownAt ?? 0);
            const remaining = Math.max(0, this.minDisplayTime - elapsed);

            this.timeoutId = setTimeout(() => {
                this.show = false;
                this.shownAt = null;
                document.body.style.overflow = '';
                this.timeoutId = null;
            }, remaining);
        },
    };
}

export default loadingScreen;