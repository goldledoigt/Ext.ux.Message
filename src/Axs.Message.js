Ext.ns('Axs');

Axs.Message = (function(config) {

	var el = false;

	var boxTpl = null;

	var config = {
		baseCls:"axs-message"
		,boxDisplayTime:4000
	};

	config.boxTpl = '<div class="'+config.baseCls+'-box-wrap">'
		+ '<div class="'+config.baseCls+'-box '+config.baseCls+'-box-{type}">{text}</div>'
		+ '</div>';

	var boxTpl = null;

	function init(cfg) {
		if (Ext.isReady) {
			if (cfg) {
				if (cfg.id) el = Ext.get(cfg.id);
				Ext.apply(config, cfg);
			}
			if (!el) el = createEl();
			boxTpl = new Ext.Template(
				config.boxTpl
				,{compiled:true}
			);
		} else {
			Ext.onReady(init.createDelegate(this, [cfg]));
		}
	}

	function createEl() {
		var el = Ext.DomHelper.append(Ext.getBody(), {
			cls:config.baseCls
		}, true);
		return el;
	}

	function add(data) {
		var box = el.insertHtml("beforeEnd", boxTpl.apply(data), true);
		var inner = box.first();
		inner.hide();
		inner.fadeIn();
		autoDestroy(box);
	}

	function autoDestroy(box) {
		(function() {
			var inner = this.first();
			inner.fadeOut({
				scope:this
				,callback:function() {
					this.setHeight(0, {
						callback:function() {
							this.remove();
						}
					});
				}
			});
		}).defer(config.boxDisplayTime, box);
	}

	return {
		init:init
		,info:function(message) {
			add({type:"info", text:message});
		}
		,warning:function(message) {
			add({type:"warning", text:message});
		}
		,error:function(message) {
			add({type:"error", text:message});
		}
	};

})();
