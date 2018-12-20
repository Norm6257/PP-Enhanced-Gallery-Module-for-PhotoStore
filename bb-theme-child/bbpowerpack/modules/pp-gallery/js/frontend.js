(function($) {
	PPGallery = function(settings)
	{
		this.settings       = settings;
		this.nodeClass      = '.fl-node-' + settings.id;
		this.wrapperClass   = this.nodeClass + ' .pp-photo-gallery';
		this.itemClass      = this.wrapperClass + ' .pp-photo-gallery-item';

		if ( this._hasItem() ) {
			this._initLayout();
		}
	};

	PPGallery.prototype = {

		settings        : {},
		nodeClass       : '',
		wrapperClass    : '',
		itemClass       : '',
		gallery         : null,
		cachedItems		: false,
		cachedIds		: [],

		_hasItem: function()
		{
			return $(this.itemClass).length > 0;
		},

		_initLayout: function()
		{
			if ( this.settings.layout === 'masonry' ) {
				this._masonryLayout();
			}

			if ( this.settings.layout === 'justified' ) {
				this._justifiedLayout();
			}

			if ( this.settings.lightbox ) {
				this._initLightbox();
			}

			if ( this.settings.pagination && 'none' !== this.settings.pagination ) {
				this._initPagination();
			}

			$(this.itemClass).css('visibility', 'visible');
		},

		_masonryLayout: function()
		{
			var wrap = $(this.wrapperClass);

			var isotopeData = {
				itemSelector: '.pp-gallery-masonry-item',
				percentPosition: true,
				transitionDuration: '0.6s',
				masonry: {
					columnWidth: '.pp-gallery-masonry-item',
					gutter: '.pp-photo-space'
				},
			};

			wrap.imagesLoaded( $.proxy( function() {
				wrap.isotope(isotopeData);
			}, this ) );
		},

		_justifiedLayout: function()
		{
			var wrap = $(this.wrapperClass);

			wrap.imagesLoaded( $.proxy(function () {
				$(this.wrapperClass).justifiedGallery({
					margins: this.settings.spacing,
					rowHeight: this.settings.rowHeight,
					maxRowHeight: this.settings.maxRowHeight,
					lastRow: this.settings.lastRow,
				});
			}, this));
		},

		_initLightbox: function()
		{
			var id = this.id;
			var options = {
				modal			: false,
				baseClass		: 'fancybox-' + id,
				buttons			: [
					'zoom',
					'slideShow',
					'fullScreen',
					'close'
				],
				wheel			: false,
				afterLoad		: function(current, previous) {
					$('.fancybox-' + id).find('.fancybox-bg').addClass('fancybox-' + id + '-overlay');
				},
			};

			if ( this.settings.lightboxCaption ) {
                options.caption = function(instance, item) {
                    var caption = $(this).attr('title') || '';
                    var desc = $(this).data('description') || '';
                    if (desc !== '') {
                        caption += '<div class="pp-fancybox-desc">' + desc + '</div>';
                    }
                    return caption;
                };
			}

			if ( this.settings.lightboxThumbs ) {
				options.buttons.push( 'thumbs' );
				options['thumbs'] = {
					autoStart: true, // Display thumbnails on opening
					hideOnClose: true, // Hide thumbnail grid when closing animation starts
					parentEl: ".fancybox-container", // Container is injected into this element
					axis: "y" // Vertical (y) or horizontal (x) scrolling
				}
			}

			$(this.nodeClass).find('a[data-fancybox="images"]').fancybox( options );
		},

		_initPagination: function()
		{
			var self = this;
			
			$(this.itemClass).each(function() {
				self.cachedIds.push( $(this).data('item-id') );
			});

			if ( 'load_more' === this.settings.pagination ) {
				this._initLoadMore();
			}
		},

		_initLoadMore: function()
		{
			var self = this;

			$(this.nodeClass).find( '.pp-gallery-load-more' ).on('click', function(e) {
				e.preventDefault();

				var $this = $(this);
				$this.addClass('disabled loading');

				if ( self.cachedItems ) {
					self._renderItems();
				} else {
					var data = {
						pp_action: 'pp_gallery_get_photos',
						node_id: self.settings.id,
						images_per_page: self.settings.perPage,
					};

					if ( self.settings.templateId ) {
						data['template_id'] = self.settings.templateId;
					}
					if ( self.settings.templateNodeId ) {
						data['template_node_id'] = self.settings.template_node_id;
					}

					$.ajax({
						type: 'post',
						url: window.location.href.split( '#' ).shift(),
						data: data,
						success: function(response) {
							response = JSON.parse(response);
							
							if ( ! response.error ) {
								self.cachedItems = response.data;
								self._renderItems();
							}
						}
					});
				}
			});
		},

		_renderItems: function()
		{
			$(this.nodeClass).find( '.pp-gallery-load-more' ).removeClass('disabled loading');

			var self = this,
				wrap = $(self.wrapperClass);

			if ( self.cachedItems ) {
				var count = 1;
				var items = [];

				$(self.cachedItems).each(function() {
					var id = $(this).data('item-id');

					if ( -1 === $.inArray( id, self.cachedIds ) ) {
						if ( count <= self.settings.perPage ) {
							self.cachedIds.push( id );
							items.push( this );
							count++;
						}
					}
				});

				if ( items.length > 0 ) {
					items = $(items).hide();
					
					// Grid layout.
					if ( self.settings.layout === 'grid' ) {
						wrap.append( items.fadeIn() );
					}
					
					// Justified layout.
					if ( self.settings.layout === 'justified' ) {
						wrap.append( items.fadeIn() );
						self._justifiedLayout();
					}

					// Masonry layout.
					if ( self.settings.layout === 'masonry' ) {
						items = items.show();
						wrap.isotope('insert', items);
						wrap.find('.pp-photo-space').remove();
						wrap.append('<div class="pp-photo-space"></div>');
						wrap.imagesLoaded($.proxy(function () {
							setTimeout(function () {
								wrap.isotope('layout');
							}, 500);
						}, this));
					}
				}

				if ( $(self.cachedItems).length === self.cachedIds.length ) {
					$(self.nodeClass).find('.pp-gallery-pagination').hide();
				}
			}
		}
	};

})(jQuery);
