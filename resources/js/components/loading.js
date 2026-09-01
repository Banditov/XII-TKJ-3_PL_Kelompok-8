function loadingScreen() {
    return {
        show: false,
        loadingCount: 0,
        timeoutId: null,

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
                    setTimeout(() => this.hideLoader(), 300);
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
                setTimeout(() => this.hideLoader(), 300);
            });
        },

        showLoader() {
            this.loadingCount++;
            this.show = true;
            document.body.style.overflow = 'hidden';

            if (this.timeoutId) {
                clearTimeout(this.timeoutId);
                this.timeoutId = null;
            }
        },

        hideLoader() {
            this.loadingCount--;

            if (this.loadingCount <= 0) {
                this.loadingCount = 0;

                this.timeoutId = setTimeout(() => {
                    this.show = false;
                    document.body.style.overflow = '';
                    this.timeoutId = null;
                }, 300);
            }
        },

        show() {
            this.showLoader();
        },

        hide() {
            this.hideLoader();
        }
    };
}

export default loadingScreen;