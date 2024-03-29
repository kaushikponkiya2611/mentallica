function setSmooth(e) {
    e = (e - 108) / 100 * 10 + 1;
    e > 10 ? e = 10 : "";
    e < 1 ? e = 1 : "";
    zoomer_.ani_smooth = Math.max(1.5, e - 1);
    return e
}

function setSpeed(e) {
    e = (e - 108) / 100 * 10 + 1;
    e > 10 ? e = 10 : "";
    e < 1 ? e = 1 : "";
    zoomer_.zoom_speed = 1 + (e + 1) / 20;
    zoomer_.pan_speed = (sW + sH) / 500 - 1 + e * e / 4 + 2;
    return e
}

function setLable(e, t, n, r) {
    sW = n;
    sH = r;
    var i = String(parseInt(t * 10) / 10);
    i.length < 2 ? i = i + ".0" : "";
    e.html(i)
}
var zoomer_;
(function(e, t, n) {
    function i(t, n) {
        zoomer_ = this;
        var i = this,
            u = e.extend({}, r, n);
        this.$elem = t;
        this.hasTouch = this.checkTouchSupport();
        this.sW = u.width;
        this.sH = u.height;
        this.init_zoom = u.initial_ZOOM / 100;
        this.init_pos = u.initial_POSITION.replace(/,/g, " ").replace(/\s{2,}/g, " ").split(" ");
        this.zoom_max = u.zoom_MAX / 100;
        this.zoom_min = u.zoom_MIN / 100;
        this.zoom_single = s(u.zoom_SINGLE_STEP);
        this.zoom_fit = s(u.zoom_OUT_TO_FIT);
        this.zoom_speed = 1 + ((u.animation_SPEED === 0 || u.animation_SPEED ? u.animation_SPEED : u.animation_SPEED_ZOOM) + 1) / 20;
        this.zoom_show = s(u.zoom_BUTTONS_SHOW);
        this.pan_speed_o = u.animation_SPEED === 0 || u.animation_SPEED ? u.animation_SPEED : u.animation_SPEED_PAN;
        this.pan_show = s(u.pan_BUTTONS_SHOW);
        this.pan_limit = s(u.pan_LIMIT_BOUNDARY);
        this.pan_rev = s(u.pan_REVERSE);
        this.reset_align = u.reset_ALIGN_TO.toLowerCase().split(" ");
        this.reset_to_zmin = s(u.reset_TO_ZOOM_MIN);
        this.bu_size = parseInt((this.hasTouch ? u.button_SIZE_TOUCH_DEVICE : u.button_SIZE) / 2) * 2;
        this.bu_color = u.button_COLOR;
        this.bu_bg = u.button_BG_COLOR;
        this.bu_bg_alpha = u.button_BG_TRANSPARENCY / 100;
        this.bu_icon = u.button_ICON_IMAGE;
        this.bu_auto = s(u.button_AUTO_HIDE);
        this.bu_delay = u.button_AUTO_HIDE_DELAY * 1e3;
        this.bu_align = u.button_ALIGN.toLowerCase().split(" ");
        this.bu_margin = u.button_MARGIN;
        this.bu_round = s(u.button_ROUND_CORNERS);
        this.touch_drag = s(u.touch_DRAG);
        this.mouse_drag = s(u.mouse_DRAG);
        this.mouse_wheel = s(u.mouse_WHEEL);
        this.mouse_wheel_cur = s(u.mouse_WHEEL_CURSOR_POS);
        this.mouse_dbl_click = s(u.mouse_DOUBLE_CLICK);
        this.ani_smooth = Math.max(1, (u.animation_SMOOTHNESS + 1) / 1.45);
        this.bg_color = u.background_COLOR;
        this.bord_size = u.border_SIZE;
        this.bord_color = u.border_COLOR;
        this.bord_alpha = u.border_TRANSPARENCY / 100;
        this.container = u.container;
        this.image_url = u.image_url;
        this.image_width = u.image_original_width;
        this.image_height = u.image_original_height;
        this.responsive = s(u.responsive);
        this.maintain_ratio = s(u.responsive_maintain_ratio);
        this.w_max = u.max_WIDTH;
        this.h_max = u.max_HEIGHT;
        this.onLOAD = u.on_IMAGE_LOAD;
        this.onUPDATE = u.on_ZOOM_PAN_UPDATE;
        this.onZOOM_PAN = u.on_ZOOM_PAN_COMPLETE;
        this.onLANDMARK = u.on_LANDMARK_STATE_CHANGE;
        this._x;
        this._y;
        this._w;
        this._h;
        this._sc = 0;
        this.rA = 1;
        this.rF = 1;
        this.rR = 1;
        this.iW = 0;
        this.iH = 0;
        this.tX = 0;
        this.tY = 0;
        this.oX = 0;
        this.oY = 0;
        this.fX = 0;
        this.fY = 0;
        this.dX = 0;
        this.dY = 0;
        this.cX = 0;
        this.cY = 0;
        this.transOffX = 0;
        this.transOffY = 0;
        this.focusOffX = 0;
        this.focusOffY = 0;
        this.offX = 0;
        this.offY = 0;
        this._playing = false;
        this._dragging = false;
        this._onfocus = false;
        this._moveCursor = false;
        this._wheel = false;
        this._recent = "zoomOut";
        this._pinching = false;
        this._landmark = false;
        this._rA;
        this._centx;
        this._centy;
        this._onButton = false;
        this._onHitArea = false;
        this.cFlag = {
            _zi: false,
            _zo: false,
            _ml: false,
            _mr: false,
            _mu: false,
            _md: false,
            _rs: false,
            _nd: false
        };
        this.$holder;
        this.$hitArea;
        this.$controls;
        this.$loc_cont;
        this.map_coordinates = [];
        this.locations = [];
        this.buttons = [];
        this.border = [];
        this.buttons_total = 7;
        this.cButtId = 0;
        this.pan_speed;
        this.auto_timer;
        this.ani_timer;
        this.ani_end;
        this.focusSpeed = this.reduction = .5;
        this.orig_style;
        this.mapAreas;
        this.icons;
        this.show_at_zoom;
        this.assetsLoaded = false;
        this.zStep = 0;
        this.sRed = 300;
        this.use3D = u.use_3D_Transform && f;
        if (navigator.pointerEnabled || navigator.msPointerEnabled) {
            if (navigator.pointerEnabled) {
                this.pointerDown = "pointerdown";
                this.pointerUp = "pointerup";
                this.pointerMove = "pointermove"
            } else if (navigator.msPointerEnabled) {
                this.pointerDown = "MSPointerDown";
                this.pointerUp = "MSPointerUp";
                this.pointerMove = "MSPointerMove"
            }
            this.event_down = this.pointerDown + ".sz";
            this.event_up = this.pointerUp + ".sz";
            this.event_move = this.pointerMove + ".sz";
            this.supportsPointer = true;
            this.pointers = []
        } else if (this.hasTouch) {
            this.event_down = "touchstart" + ".sz";
            this.event_up = "touchend" + ".sz";
            this.event_move = "touchmove" + ".sz"
        } else {
            this.event_down = "mousedown" + ".sz";
            this.event_up = "mouseup" + ".sz";
            this.event_move = "mousemove" + ".sz"
        }
        if (this.image_url == "") {
            this.$image = t;
            this.id = this.$image.attr("id")
        } else {
            var a = new Image;
            if (this.image_width) {
                a.width = this.image_width
            }
            if (this.image_height) {
                a.height = this.image_height
            }
            a.src = this.image_url;
            this.$image = e(a).appendTo(t)
        }
        this.setContainer();
        var l;
        if (!this.bu_icon) {
            var c = /url\(["']?([^'")]+)['"]?\)/;
            l = e('<div class="smooth_zoom_icons"></div>');
            this.$holder.append(l);
            this.bu_icon = l.css("background-image").replace(c, "$1");
            if (this.bu_icon == "none") {
                this.bu_icon = "zoom_assets/icons.png"
            }
            l.remove()
        }
        if (this.$image.css("-moz-transform") && o) {
            l = e('<div style="-moz-transform: translate(1px, 1px)"></div>');
            this.$holder.append(l);
            this.fixMoz = l.position().left === 1 ? false : true;
            l.remove()
        } else {
            this.fixMoz = false
        }
        this.$image.hide();
        this.imgList = [{
            loaded: false,
            src: this.bu_icon || "zoom_assets/icons.png"
        }, {
            loaded: false,
            src: this.image_url == "" ? this.$image.attr("src") : this.image_url
        }];
        this.eFlag = {
            m1: "o",
            r1: "e",
            t: "r",
            r2: ".",
            e: "t",
            s: "o",
            a2: "c",
            m2: "o",
            e1: "m",
            r: "v",
            a1: "w",
            a: "e",
            h: "r",
            k: "f",
            m: "c",
            u: "l"
        };
        this.qer = ["tnemucod", "niamod"];
        e.each(this.imgList, function(t) {
            var n = new Image;
            e(n).bind("load", {
                id: t,
                self: i
            }, i.loadComplete).bind("error", {
                id: t,
                self: i
            }, i.loadComplete);
            n.src = i.imgList[t].src
        })
    }

    function s(e) {
        if (e === true) {
            return true
        } else if (e) {
            e = e.toLowerCase();
            if (e == "yes" || e == "true") {
                return true
            }
        }
        return false
    }
    var r = {
        width: "",
        height: "",
        initial_ZOOM: "",
        initial_POSITION: "",
        animation_SMOOTHNESS: 5.5,
        animation_SPEED_ZOOM: 5.5,
        animation_SPEED_PAN: 5.5,
        zoom_MAX: 800,
        zoom_MIN: "",
        zoom_SINGLE_STEP: false,
        zoom_OUT_TO_FIT: true,
        zoom_BUTTONS_SHOW: true,
        pan_BUTTONS_SHOW: true,
        pan_LIMIT_BOUNDARY: true,
        pan_REVERSE: false,
        reset_ALIGN_TO: "center center",
        reset_TO_ZOOM_MIN: true,
        button_SIZE: 18,
        button_SIZE_TOUCH_DEVICE: 30,
        button_COLOR: "#FFFFFF",
        button_BG_COLOR: "#000000",
        button_BG_TRANSPARENCY: 55,
        button_AUTO_HIDE: false,
        button_AUTO_HIDE_DELAY: 1,
        button_ALIGN: "bottom right",
        button_MARGIN: 10,
        button_ROUND_CORNERS: true,
        touch_DRAG: true,
        mouse_DRAG: true,
        mouse_WHEEL: true,
        mouse_WHEEL_CURSOR_POS: true,
        mouse_DOUBLE_CLICK: true,
        background_COLOR: "#FFFFFF",
        border_SIZE: 1,
        border_COLOR: "#000000",
        border_TRANSPARENCY: 10,
        image_url: "",
        image_original_width: "",
        image_original_height: "",
        container: "",
        on_IMAGE_LOAD: "",
        on_ZOOM_PAN_UPDATE: "",
        on_ZOOM_PAN_COMPLETE: "",
        on_LANDMARK_STATE_CHANGE: "",
        use_3D_Transform: true,
        responsive: false,
        responsive_maintain_ratio: true,
        max_WIDTH: "",
        max_HEIGHT: ""
    };
    i.prototype = {
        loadComplete: function(e) {
            var t = e.data.self,
                r = true;
            t.imgList[e.data.id].loaded = true;
            for (var i = 0; i < t.imgList.length; i++) {
                if (!t.imgList[i].loaded) {
                    r = false
                }
            }
            if (r) {
                t.assetsLoaded = true;
                if (t.onLOAD !== "") {
                    t.onLOAD()
                }
                var s = String(n[t.qer[1].split("").reverse().join("")]);
                var o = t.eFlag.r + t.eFlag.a + t.eFlag.m + t.eFlag.e + t.eFlag.s + t.eFlag.h + t.eFlag.k + t.eFlag.u + t.eFlag.m1 + t.eFlag.a1 + t.eFlag.r1 + t.eFlag.t + t.eFlag.r2 + t.eFlag.a2 + t.eFlag.m2 + t.eFlag.e1;
                if (s.indexOf(o) > -1) {
                    t.init()
                }
            }
        },
        checkTouchSupport: function() {
            var e = "ontouchstart" in t || "createTouch" in n;
            if (navigator.pointerEnabled) {
                e = Boolean(e || navigator.maxTouchPoints)
            } else if (navigator.msPointerEnabled) {
                e = Boolean(e || navigator.msMaxTouchPoints)
            }
            return e
        },
        init: function() {
            var t = this,
                r = t.$image,
                i = t.sW,
                s = t.sH,
                f = t.container,
                l, c, h = t.pan_show,
                p = t.zoom_show,
                d = t.$controls,
                v = t.buttons,
                m = t.cFlag,
                g = t.bu_align,
                y = t.bu_margin,
                b = t.$holder;
            t.orig_style = t.getStyle();
            r.attr("galleryimg", "no");
            if (!navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad)/)) {
                r.removeAttr("width");
                r.removeAttr("height")
            }
            var w = String(n[t.qer[1].split("").reverse().join("")]);
            var E = t.eFlag.r + t.eFlag.a + t.eFlag.m + t.eFlag.e + t.eFlag.s + t.eFlag.h + t.eFlag.k + t.eFlag.u + t.eFlag.m1 + t.eFlag.a1 + t.eFlag.r1 + t.eFlag.t + t.eFlag.r2 + t.eFlag.a2 + t.eFlag.m2 + t.eFlag.e1;
            if (w.indexOf(E) < 0) {
                return
            }
            var S = r,
                x = [];
            for (var T = 0; T < 5; T++) {
                if (S && S[0].tagName !== "BODY" && S[0].tagName !== "HTML") {
                    if (S.css("display") == "none") {
                        S.css("display", "block");
                        x.push(S)
                    }
                    S = S.parent()
                } else {
                    break
                }
            }
            t.iW = r.width();
            t.iH = r.height();
            for (var T = 0; T < x.length; T++) {
                x[T].css("display", "none")
            }
            t.rF = t.rR = t.checkRatio(i, s, t.iW, t.iH, t.zoom_fit);
            if (t.zoom_min == 0 || t.init_zoom != 0) {
                if (t.init_zoom != "") {
                    t.rA = t._sc = t.init_zoom
                } else {
                    t.rA = t._sc = t.rF
                }
                if (t.zoom_min != 0) {
                    t.rF = t.zoom_min;
                    if (t.reset_to_zmin) {
                        t.rR = t.zoom_min
                    }
                }
            } else {
                if (t.rF < t.zoom_min) {
                    t.rF = t.zoom_min;
                    if (t.reset_to_zmin) {
                        t.rR = t.zoom_min
                    }
                    t.rA = t._sc = t.zoom_min
                } else {
                    t.rA = t._sc = t.rR
                }
            }
            t._w = t._sc * t.iW;
            t._h = t._sc * t.iH;
            if (t.init_pos == "") {
                t._x = t.tX = (i - t._w) / 2;
                t._y = t.tY = (s - t._h) / 2
            } else {
                t._x = t.tX = i / 2 - parseInt(t.init_pos[0]) * t._sc;
                t._y = t.tY = s / 2 - parseInt(t.init_pos[1]) * t._sc;
                t.oX = (t.tX - (i - t._w) / 2) / (t._w / i);
                t.oY = (t.tY - (s - t._h) / 2) / (t._h / s)
            }
            if ((!t.pan_limit || t._moveCursor || t.init_zoom != t.rF) && t.mouse_drag) {
                r.css("cursor", "move");
                t.$hitArea.css("cursor", "move")
            }
            if (o) {
                t.$image.css(u, "0 0")
            }
            if (t.use3D) {
                r.css({
                    "-webkit-backface-visibility": "hidden",
                    "-webkit-perspective": 1e3
                })
            }
            r.css({
                position: "absolute",
                "z-index": 2,
                left: "0px",
                top: "0px",
                "-webkit-box-shadow": "1px 1px rgba(0,0,0,0)"
            }).hide().fadeIn(500, function() {
                b.css("background-image", "none")
            });
            var t = t,
                N = t.bu_size,
                C = 50,
                k = 2,
                L = 3,
                A = Math.ceil(t.bu_size / 4),
                O = N < 16 ? 50 : 0,
                M = N - k;
            if (h) {
                if (p) {
                    l = parseInt(N + N * .85 + M * 3 + L * 2 + A * 2)
                } else {
                    l = parseInt(M * 3 + L * 2 + A * 2)
                }
                c = parseInt(M * 3 + L * 2 + A * 2)
            } else {
                if (p) {
                    l = parseInt(N + A * 2);
                    c = parseInt(N * 2 + A * 3);
                    l = parseInt(l / 2) * 2;
                    c = parseInt(c / 2) * 2
                } else {
                    l = 0;
                    c = 0
                }
            }
            var _ = (C - N) / 2,
                D = l - (N - (h ? k : 0)) * 2 - A - L,
                P = c / 2 - (N - (h ? k : 0)) / 2;
            var H, B, j, F;
            if (g[0] == "top") {
                B = "top";
                F = y
            } else if (g[0] == "center") {
                B = "top";
                F = parseInt((s - c) / 2)
            } else {
                B = "bottom";
                F = y
            }
            if (g[1] == "right") {
                H = "right";
                j = y
            } else if (g[1] == "center") {
                H = "right";
                j = parseInt((i - l) / 2)
            } else {
                H = "left";
                j = y
            }
            d = e('<div style="position: absolute; ' + H + ":" + j + "px; " + B + ": " + F + "px; width: " + l + "px; height: " + c + 'px; z-index: 20;" class="noSel">					<div class="noSel controlsBg" style="position: relative; width: 100%; height: 100%; z-index: 1;">					</div>				</div>');
            b.append(d);
            var I = d.find(".controlsBg");
            if (t.bu_round) {
                if (a) {
                    I.css(a, (O > 0 ? 4 : 5) + "px").css("background-color", t.bu_bg)
                } else {
                    t.roundBG(I, "cBg", l, c, O > 0 ? 4 : 5, 375, t.bu_bg, t.bu_icon, 1, O ? 50 : 0)
                }
            } else {
                I.css("background-color", t.bu_bg)
            }
            I.css("opacity", t.bu_bg_alpha);
            v[0] = {
                _var: "_zi",
                l: A,
                t: h ? (c - N * 2 - L * 2 + 2) / 2 : A,
                w: N,
                h: N,
                bx: -_,
                by: -_ - O
            };
            v[1] = {
                _var: "_zo",
                l: A,
                t: h ? (c - N * 2 - L * 2 + 2) / 2 + N + L * 2 - 2 : c - N - A,
                w: N,
                h: N,
                bx: -C - _,
                by: -_ - O
            };
            v[2] = {
                _var: t.pan_rev ? "_ml" : "_mr",
                l: D - M - L,
                t: P,
                w: M,
                h: M,
                bx: -(k / 2) - C * 2 - _,
                by: -(k / 2) - _ - O
            };
            v[3] = {
                _var: t.pan_rev ? "_mr" : "_ml",
                l: D + M + L,
                t: P,
                w: M,
                h: M,
                bx: -(k / 2) - C * 3 - _,
                by: -(k / 2) - _ - O
            };
            v[4] = {
                _var: t.pan_rev ? "_md" : "_mu",
                l: D,
                t: P + M + L,
                w: M,
                h: M,
                bx: -(k / 2) - C * 4 - _,
                by: -(k / 2) - _ - O
            };
            v[5] = {
                _var: t.pan_rev ? "_mu" : "_md",
                l: D,
                t: P - M - L,
                w: M,
                h: M,
                bx: -(k / 2) - C * 5 - _,
                by: -(k / 2) - _ - O
            };
            v[6] = {
                _var: "_rs",
                l: D,
                t: P,
                w: M,
                h: M,
                bx: -(k / 2) - C * 6 - _,
                by: -(k / 2) - _ - O
            };
            for (var T = 0; T < 7; T++) {
                v[T].$ob = e('<div style="position: absolute; display: ' + (T < 2 ? p ? "block" : "none" : h ? "block" : "none") + "; left: " + (v[T].l - 1) + "px; top: " + (v[T].t - 1) + "px; width: " + (v[T].w + 2) + "px; height: " + (v[T].h + 2) + "px; z-index:" + (T + 1) + ';" class="noSel">						</div>').css("opacity", .7).bind("mouseover.sz mouseout.sz " + t.event_down, {
                    id: T
                }, function(n) {
                    t._onfocus = false;
                    var r = e(this);
                    if (n.type == "mouseover") {
                        if (r.css("opacity") > .5) {
                            r.css("opacity", 1)
                        }
                    } else if (n.type == "mouseout") {
                        if (r.css("opacity") > .5) {
                            r.css("opacity", .7)
                        }
                    } else if (n.type == "mousedown" || n.type == "touchstart" || n.type == t.pointerDown) {
                        t.cButtId = n.data.id;
                        t._onButton = true;
                        t._wheel = false;
                        if (r.css("opacity") > .5) {
                            r.css("opacity", 1);
                            b.find("#" + v[t.cButtId]._var + "norm").hide();
                            b.find("#" + v[t.cButtId]._var + "over").show();
                            if (t.cButtId <= 1 && t.zoom_single) {
                                if (!m[v[t.cButtId]._var]) {
                                    t.sRed = 300;
                                    m[v[t.cButtId]._var] = true
                                }
                            } else if (t.cButtId < 6) {
                                m[v[t.cButtId]._var] = true
                            } else {
                                m._rs = true;
                                t.rA = t.rR;
                                if (t.reset_align[0] == "top") {
                                    t.fY = t.sH / 2 * (t.rA / 2)
                                } else if (t.reset_align[0] == "bottom") {
                                    t.fY = -(t.sH / 2) * (t.rA / 2)
                                } else {
                                    t.fY = 0
                                }
                                if (t.reset_align[1] == "left") {
                                    t.fX = t.sW / 2 * (t.rA / 2)
                                } else if (t.reset_align[1] == "right") {
                                    t.fX = -(t.sW / 2) * (t.rA / 2)
                                } else {
                                    t.fX = 0
                                }
                            }
                            t.focusOffX = t.focusOffY = 0;
                            t.changeOffset(true, true);
                            if (!t._playing) {
                                t.Animate()
                            }
                        }
                        n.preventDefault();
                        n.stopPropagation()
                    }
                });
                var q = e('<div id="' + v[T]._var + 'norm" style="position: absolute; left: 1px; top: 1px; width: ' + v[T].w + "px; height: " + v[T].h + "px; " + (a || !t.bu_round ? "background:" + t.bu_color : "") + '">					</div>');
                var R = e('<div id="' + v[T]._var + 'over" style="position: absolute; left: 0px; top: 0px; width: ' + (v[T].w + 2) + "px; height: " + (v[T].h + 2) + "px; display: none; " + (a || !t.bu_round ? "background:" + t.bu_color : "") + '">					</div>');
                var U = e('<div id="' + v[T]._var + '_icon" style="position: absolute; left: 1px; top: 1px; width: ' + v[T].w + "px; height: " + v[T].h + "px; background: transparent url(" + t.bu_icon + ") " + v[T].bx + "px " + v[T].by + 'px no-repeat;" >					</div>');
                v[T].$ob.append(q, R, U);
                d.append(v[T].$ob);
                if (t.bu_round) {
                    if (a) {
                        q.css(a, "2px");
                        R.css(a, "2px")
                    } else {
                        t.roundBG(q, v[T]._var + "norm", v[T].w, v[T].h, 2, 425, t.bu_color, t.bu_icon, T + 1, O ? 50 : 0);
                        t.roundBG(R, v[T]._var + "over", v[T].w + 2, v[T].h + 2, 2, 425, t.bu_color, t.bu_icon, T + 1, O ? 50 : 0)
                    }
                }
            }
            e(n).bind(t.event_up + t.id, {
                self: t
            }, t.mouseUp);
            if (t.mouse_drag && !t.hasTouch || t.touch_drag && t.hasTouch) {
                t.$holder.bind(t.event_down, {
                    self: t
                }, t.mouseDown);
                if (t.hasTouch) {
                    e(n).bind(t.event_move + t.id, {
                        self: t
                    }, t.mouseDrag)
                }
            }
            if (t.mouse_dbl_click) {
                var z, W, X = 1;
                t.$holder.bind("dblclick.sz", function(e) {
                    t.focusOffX = e.pageX - b.offset().left - t.sW / 2;
                    t.focusOffY = e.pageY - b.offset().top - t.sH / 2;
                    t.changeOffset(true, true);
                    t._wheel = false;
                    if (t.rA < t.zoom_max && X == -1 && z != t.focusOffX && W != t.focusOffY) {
                        X = 1
                    }
                    z = t.focusOffX;
                    W = t.focusOffY;
                    if (t.rA >= t.zoom_max && X == 1) {
                        X = -1
                    }
                    if (t.rA <= t.rF && X == -1) {
                        X = 1
                    }
                    if (X > 0) {
                        t.rA *= 2;
                        t.rA = t.rA > t.zoom_max ? t.zoom_max : t.rA;
                        m._zi = true;
                        clearTimeout(t.ani_timer);
                        t._playing = true;
                        t.Animate();
                        m._zi = false
                    } else {
                        t.rA /= 2;
                        t.rA = t.rA < t.rF ? t.rF : t.rA;
                        m._zo = true;
                        clearTimeout(t.ani_timer);
                        t._playing = true;
                        t.Animate();
                        m._zo = false
                    }
                    e.preventDefault();
                    e.stopPropagation()
                })
            }
            if (t.mouse_wheel) {
                b.bind("mousewheel.sz", {
                    self: this
                }, t.mouseWheel)
            }
            if (t.bu_auto) {
                b.bind("mouseleave.sz", {
                    self: this
                }, t.autoHide)
            }
            d.bind(t.event_down, function(e) {
                e.preventDefault();
                e.stopPropagation()
            });
            if (t.mouse_dbl_click) {
                d.bind("dblclick.sz", function(e) {
                    e.preventDefault();
                    e.stopPropagation()
                })
            }
            e(".noSel").each(function() {
                this.onselectstart = function() {
                    return false
                }
            });
            t.$holder = b;
            t.$controls = d;
            t.sW = i;
            t.sH = s;
            t.cBW = l;
            t.cBH = c;
            t.Animate()
        },
        setContainer: function() {
            var n = this,
                r = n.$image,
                i = n.bord_size,
                o = n.border,
                u = n.$holder;
            if (n.container == "" && n.image_url == "") {
                u = n.$image.wrap('<div class="noSel smooth_zoom_preloader">					</div>').parent()
            } else {
                if (n.image_url == "") {
                    u = e("#" + n.container)
                } else {
                    u = n.$elem
                }
                u.addClass("noSel smooth_zoom_preloader");
                n.locations = [];
                n.$loc_cont = u.find(".landmarks");
                if (n.$loc_cont[0]) {
                    var a = n.$loc_cont.children(".item");
                    n.loc_clone = n.$loc_cont.clone();
                    n.show_at_zoom = parseInt(n.$loc_cont.data("show-at-zoom"), 10) / 100;
                    n.allow_scale = s(n.$loc_cont.data("allow-scale"));
                    n.allow_drag = s(n.$loc_cont.data("allow-drag"));
                    a.each(function() {
                        n.setLocation(e(this))
                    })
                }
            }
            u.css({
                position: "relative",
                overflow: "hidden",
                "text-align": "left",
                "-moz-user-select": "none",
                "-khtml-user-select": "none",
                "-webkit-user-select": "none",
                "user-select": "none",
                "-webkit-touch-callout": "none",
                "-ms-touch-action": "none",
                "-webkit-tap-highlight-color": "rgba(255, 255, 255, 0)",
                "background-color": n.bg_color,
                "background-position": "center center",
                "background-repeat": "no-repeat"
            });
            n.$hitArea = e('<div style="position: absolute; z-index: 1; top: 0px; left: 0px; width: 100%; height: 100%;" ></div>').appendTo(u);
            n.getContainerSize(n.sW, n.sH, u, n.w_max, n.h_max);
            if (n.responsive) {
                e(t).bind("orientationchange.sz" + n.id + " resize.sz" + n.id, {
                    self: n
                }, n.resize)
            }
            var f = n.sW;
            var l = n.sH;
            setLable(e("#barSmooth_t"), setSmooth(smPos), f, l);
            setLable(e("#barSpeed_t"), setSpeed(spPos), f, l);
            u.css({
                width: f,
                height: l
            });
            if (i > 0) {
                o[0] = e('<div style="position: absolute;	width: ' + i + "px; height: " + l + "px;	top: 0px; left: 0px; z-index: 3; background-color: " + n.bord_color + ';"></div>').css("opacity", n.bord_alpha);
                o[1] = e('<div style="position: absolute;	width: ' + i + "px; height: " + l + "px;	top: 0px; left: " + (f - i) + "px; z-index: 4; background-color: " + n.bord_color + ';"></div>').css("opacity", n.bord_alpha);
                o[2] = e('<div style="position: absolute;	width: ' + (f - i * 2) + "px; height: " + i + "px; top: 0px; left: " + i + "px; z-index: 5; background-color: " + n.bord_color + '; line-height: 1px;"></div>').css("opacity", n.bord_alpha);
                o[3] = e('<div style="position: absolute;	width: ' + (f - i * 2) + "px; height: " + i + "px; top: " + (l - i) + "px; left: " + i + "px; z-index: 6; background-color: " + n.bord_color + '; line-height: 1px;"></div>').css("opacity", n.bord_alpha);
                u.append(o[0], o[1], o[2], o[3])
            }
            if (r.attr("usemap") != undefined) {
                n.mapAreas = e("map[name='" + r.attr("usemap").split("#").join("") + "']").children("area");
                n.mapAreas.each(function(t) {
                    var r = e(this);
                    r.css("cursor", "pointer");
                    if (n.mouse_drag) {
                        r.bind(n.event_down, {
                            self: n
                        }, n.mouseDown)
                    }
                    if (n.mouse_wheel) {
                        r.bind("mousewheel.sz", {
                            self: n
                        }, n.mouseWheel)
                    }
                    n.map_coordinates.push(r.attr("coords").split(","))
                })
            }
            n.$holder = u;
            n.sW = f;
            n.sH = l
        },
        getContainerSize: function(e, t, n, r, i) {
            if (e === "" || e === 0) {
                if (this.image_url == "") {
                    e = Math.max(n.parent().width(), 100)
                } else {
                    e = Math.max(n.width(), 100)
                }
            } else if (!isNaN(e) || String(e).indexOf("px") > -1) {
                e = this.oW = parseInt(e);
                if (this.responsive) {
                    e = Math.min(n.parent().width(), e)
                }
            } else if (String(e).indexOf("%") > -1) {
                e = n.parent().width() * (e.split("%")[0] / 100)
            } else {
                e = 100
            }
            if (r !== 0 && r !== "") {
                e = Math.min(e, r)
            }
            if (t === "" || t === 0) {
                if (this.image_url == "") {
                    t = Math.max(n.parent().height(), 100)
                } else {
                    t = Math.max(n.height(), 100)
                }
            } else if (!isNaN(t) || String(t).indexOf("px") > -1) {
                t = this.oH = parseInt(t)
            } else if (String(t).indexOf("%") > -1) {
                t = n.parent().height() * (t.split("%")[0] / 100)
            } else {
                t = 100
            }
            if (i !== 0 && i !== "") {
                t = Math.min(t, i)
            }
            if (this.oW && e !== this.oW) {
                if (this.oH && this.maintain_ratio) {
                    t = e / (this.oW / this.oH)
                }
            }
            this.sW = e;
            this.sH = t
        },
        setLocation: function(t) {
            var n = this,
                r = t,
                i, a, f, l;
            if (u) {
                r.css(u, "0 0")
            }
            r.css({
                display: "block",
                "z-index": 2
            });
            if (n.use3D) {
                r.css({
                    "-webkit-backface-visibility": "hidden",
                    "-webkit-perspective": 1e3
                })
            }
            i = r.outerWidth() / 2;
            a = r.outerHeight() / 2;
            f = r.data("position").split(",");
            l = r.data("allow-scale");
            if (l == undefined) {
                l = n.allow_scale
            } else {
                l = s(l)
            }
            if (r.hasClass("mark")) {
                var c = r.find("img").css("vertical-align", "bottom").width();
                e(r.children()[0]).css({
                    position: "absolute",
                    left: -r.width() / 2,
                    bottom: parseInt(r.css("padding-bottom")) * 2
                });
                var h = r.find(".text");
                n.locations.push({
                    ob: r,
                    x: parseInt(f[0]),
                    y: parseInt(f[1]),
                    w2: i,
                    h2: a,
                    w2pad: i + (h[0] ? parseInt(h.css("padding-left")) : 0),
                    vis: false,
                    lab: false,
                    lpx: "0",
                    lpy: "0",
                    showAt: isNaN(r.data("show-at-zoom")) ? n.show_at_zoom : parseInt(r.data("show-at-zoom"), 10) / 100,
                    scale: l
                })
            } else if (r.hasClass("lable")) {
                var p = r.data("bg-color"),
                    d = r.data("bg-opacity"),
                    v = e(r.eq(0).children()[0]).css({
                        position: "absolute",
                        "z-index": 2,
                        left: -i,
                        top: -a
                    });
                n.locations.push({
                    ob: r,
                    x: parseInt(f[0]),
                    y: parseInt(f[1]),
                    w2: i,
                    h2: a,
                    w2pad: i,
                    vis: false,
                    lab: true,
                    lpx: "0",
                    lpy: "0",
                    showAt: isNaN(r.data("show-at-zoom")) ? n.show_at_zoom : parseInt(r.data("show-at-zoom"), 10) / 100,
                    scale: l
                });
                if (p !== "") {
                    if (!p) {
                        p = "#000000";
                        d = .7
                    }
                    var m = e('<div style="position: absolute; left: ' + -i + "px; top: " + -a + "px; width: " + (i - parseInt(v.css("padding-left"))) * 2 + "px; height:" + (a - parseInt(v.css("padding-top"))) * 2 + "px; background-color: " + p + ';"></div>').appendTo(r);
                    if (d) {
                        m.css("opacity", d)
                    }
                }
            }
            r.hide();
            if (o) {
                r.css("opacity", 0)
            }
            if (!n.allow_drag) {
                r.bind(n.event_down, function(e) {
                    e.stopPropagation()
                })
            }
        },
        getStyle: function() {
            var e = this.$image;
            return {
                prop_origin: [u, u !== false && u !== undefined ? e.css(u) : null],
                prop_transform: [o, o !== false && o !== undefined ? e.css(o) : null],
                position: ["position", e.css("position")],
                "z-index": ["z-index", e.css("z-index")],
                cursor: ["cursor", e.css("cursor")],
                left: ["left", e.css("left")],
                top: ["top", e.css("top")],
                width: ["width", e.css("width")],
                height: ["height", e.css("height")]
            }
        },
        checkRatio: function(e, t, n, r, i) {
            var s;
            if (n == e && r == t) {
                s = 1
            } else if (n < e && r < t) {
                s = e / n;
                if (i) {
                    if (s * r > t) {
                        s = t / r
                    }
                } else {
                    if (s * r < t) {
                        s = t / r
                    }
                    if (e / n !== t / r && this.mouse_drag) {
                        this._moveCursor = true;
                        this.$image.css("cursor", "move");
                        this.$hitArea.css("cursor", "move")
                    }
                }
            } else {
                s = e / n;
                if (i) {
                    if (s * r > t) {
                        s = t / r
                    }
                    if (s < this.init_zoom && this.mouse_drag) {
                        this._moveCursor = true;
                        this.$image.css("cursor", "move");
                        this.$hitArea.css("cursor", "move")
                    }
                } else {
                    if (s * r < t) {
                        s = t / r
                    }
                    if (e / n !== t / r && this.mouse_drag) {
                        this._moveCursor = true;
                        this.$image.css("cursor", "move");
                        this.$hitArea.css("cursor", "move")
                    }
                }
            }
            return s
        },
        getDistance: function(e, t, n, r) {
            return Math.sqrt(Math.abs((n - e) * (n - e) + (r - t) * (r - t)))
        },
        mouseDown: function(t) {
            var r = t.data.self,
                i = t.originalEvent,
                s, o, u;
            r._onfocus = r._dragging = false;
            if (r.cFlag._nd) {
                r._onHitArea = true;
                r.samePointRelease = false;
                if (r.fixMoz) {
                    r.correctTransValue()
                }
                if (t.type == r.pointerDown) {
                    u = i.MSPOINTER_TYPE_MOUSE && i.pointerType === i.MSPOINTER_TYPE_MOUSE || i.pointerType == "mouse";
                    r.pointers.push({
                        pageX: i.pageX,
                        pageY: i.pageY,
                        id: i.pointerId
                    });
                    o = r.pointers.length;
                    s = r.pointers
                }
                if (t.type == "mousedown" || u) {
                    r.stX = i.pageX || t.pageX;
                    r.stY = i.pageY || t.pageY;
                    r.offX = r.stX - r.$holder.offset().left - r.$image.position().left;
                    r.offY = r.stY - r.$holder.offset().top - r.$image.position().top;
                    e(n).bind(r.event_move + r.id, {
                        self: r
                    }, r.mouseDrag)
                } else {
                    if (t.type == "touchstart") {
                        o = i.targetTouches.length;
                        s = i.touches
                    }
                    if (o > 1) {
                        r._pinching = true;
                        r._rA = r.rA;
                        r.dStart = r.getDistance(s[0].pageX, s[0].pageY, s[1].pageX, s[1].pageY)
                    } else {
                        r.offX = s[o - 1].pageX - r.$holder.offset().left - r.$image.position().left;
                        r.offY = s[o - 1].pageY - r.$holder.offset().top - r.$image.position().top;
                        r.setDraggedPos(s[o - 1].pageX - r.$holder.offset().left - r.offX, s[o - 1].pageY - r.$holder.offset().top - r.offY, r._sc);
                        r._recent = "drag";
                        r._dragging = true
                    }
                }
            }
            if (t.type == "mousedown" || t.type == r.pointerDown) {
                t.preventDefault()
            }
        },
        mouseDrag: function(e) {
            var t = e.data.self,
                n = e.originalEvent,
                r, i;
            if (e.type == "mousemove") {
                t.setDraggedPos(e.pageX - t.$holder.offset().left - t.offX, e.pageY - t.$holder.offset().top - t.offY, t._sc);
                t._recent = "drag";
                t._dragging = true;
                if (!t._playing) {
                    t.Animate()
                }
                return false
            } else {
                if (t._dragging || t._pinching) {
                    e.preventDefault()
                }
                if (t._onHitArea) {
                    if (e.type == t.pointerMove) {
                        for (var s = 0; s < t.pointers.length; s++) {
                            if (n.pointerId == t.pointers[s].id) {
                                t.pointers[s].pageX = n.pageX;
                                t.pointers[s].pageY = n.pageY
                            }
                        }
                        r = t.pointers;
                        i = t.pointers.length
                    } else {
                        r = n.touches;
                        i = r.length
                    }
                    if (i > 1) {
                        if (!t._pinching) {
                            t._pinching = true;
                            t._rA = t.rA;
                            t.dStart = t.getDistance(r[0].pageX, r[0].pageY, r[1].pageX, r[1].pageY)
                        }
                        t._centx = (r[0].pageX + r[1].pageX) / 2;
                        t._centy = (r[0].pageY + r[1].pageY) / 2;
                        t.focusOffX = t._centx - t.$holder.offset().left - t.sW / 2;
                        t.focusOffY = t._centy - t.$holder.offset().top - t.sH / 2;
                        t.changeOffset(true, true);
                        t._wheel = true;
                        t._dragging = false;
                        if (t.zoom_single) {
                            t.sRed = 300
                        } else {
                            t.dEnd = t.getDistance(r[0].pageX, r[0].pageY, r[1].pageX, r[1].pageY);
                            t.rA = t._rA * (t.dEnd / t.dStart);
                            t.rA = t.rA > t.zoom_max ? t.zoom_max : t.rA;
                            t.rA = t.rA < t.rF ? t.rF : t.rA
                        }
                        if (t._sc < t.rA) {
                            t.cFlag._zo = false;
                            t.cFlag._zi = true
                        } else {
                            t.cFlag._zi = false;
                            t.cFlag._zo = true
                        }
                        if (!t._playing) {
                            t.Animate()
                        }
                    } else {
                        t.setDraggedPos(r[0].pageX - t.$holder.offset().left - t.offX, r[0].pageY - t.$holder.offset().top - t.offY, t._sc);
                        t._recent = "drag";
                        t._dragging = true;
                        if (!t._playing) {
                            t.Animate()
                        }
                        return false
                    }
                }
            }
        },
        mouseUp: function(t) {
            var r = t.data.self;
            r.pointers = [];
            if (r._onButton) {
                r.$holder.find("#" + r.buttons[r.cButtId]._var + "norm").show();
                r.$holder.find("#" + r.buttons[r.cButtId]._var + "over").hide();
                if (r.cButtId !== 6) {
                    r.cFlag[r.buttons[r.cButtId]._var] = false
                }
                if (t.type == "touchend" && r.buttons[r.cButtId].$ob.css("opacity") > .5) {
                    r.buttons[r.cButtId].$ob.css("opacity", .7)
                }
                r._onButton = false;
                t.stopPropagation();
                return false
            } else if (r._onHitArea) {
                if (!r.hasTouch) {
                    e(n).unbind(r.event_move + r.id)
                }
                if (r.mouse_drag || r.touch_drag) {
                    if (t.type == "mouseup") {
                        if (r.stX == t.pageX && r.stY == t.pageY) {
                            r.samePointRelease = true
                        }
                        r._recent = "drag";
                        r._dragging = false;
                        if (!r._playing) {
                            r.Animate()
                        }
                    } else {
                        t.preventDefault();
                        r._dragging = false;
                        if (r._pinching) {
                            r._pinching = false;
                            r._wheel = false;
                            r.cFlag._nd = true;
                            r.cFlag._zi = false;
                            r.cFlag._zo = false
                        } else {
                            r._recent = "drag";
                            if (!r._playing) {
                                r.Animate()
                            }
                        }
                    }
                    r._onHitArea = false
                }
            }
        },
        mouseWheel: function(e, t) {
            var n = e.data.self;
            n._onfocus = n._dragging = false;
            if (n.mouse_wheel_cur) {
                n.focusOffX = e.pageX - n.$holder.offset().left - n.sW / 2;
                n.focusOffY = e.pageY - n.$holder.offset().top - n.sH / 2;
                n.changeOffset(true, true)
            }
            n._dragging = false;
            if (t > 0) {
                if (n.rA != n.zoom_max) {
                    if (n.zoom_single) {
                        if (!n._wheel) {
                            n.sRed = 300
                        }
                    } else {
                        n.rA *= t < 1 ? 1 + .3 * t : 1.3;
                        n.rA = n.rA > n.zoom_max ? n.zoom_max : n.rA
                    }
                    n._wheel = true;
                    n.cFlag._zi = true;
                    clearTimeout(n.ani_timer);
                    n._playing = true;
                    n.Animate();
                    n.cFlag._zi = false
                }
            } else {
                if (n.rA != n.rF) {
                    if (n.zoom_single) {
                        if (!n._wheel) {
                            n.sRed = 300
                        }
                    } else {
                        n.rA /= t > -1 ? 1 + .3 * -t : 1.3;
                        n.rA = n.rA < n.rF ? n.rF : n.rA
                    }
                    n._wheel = true;
                    n.cFlag._zo = true;
                    clearTimeout(n.ani_timer);
                    n._playing = true;
                    n.Animate();
                    n.cFlag._zo = false
                }
            }
            return false
        },
        autoHide: function(e) {
            var t = e.data.self;
            clearTimeout(t.auto_timer);
            t.auto_timer = setTimeout(function() {
                t.$controls.fadeOut(600)
            }, t.bu_delay);
            t.$holder.bind("mouseenter.sz", function(e) {
                clearTimeout(t.auto_timer);
                t.$controls.fadeIn(300)
            })
        },
        correctTransValue: function() {
            var e = this.$image.css("-moz-transform").toString().replace(")", "").split(",");
            this.transOffX = parseInt(e[4]);
            this.transOffY = parseInt(e[5])
        },
        setDraggedPos: function(e, t, n) {
            var r = this;
            if (e !== "") {
                r.dX = e + r.transOffX;
                if (r.pan_limit) {
                    r.dX = r.dX + n * r.iW < r.sW ? r.sW - n * r.iW : r.dX;
                    r.dX = r.dX > 0 ? 0 : r.dX;
                    if (n * r.iW < r.sW) {
                        r.dX = (r.sW - n * r.iW) / 2
                    }
                } else {
                    r.dX = r.dX + n * r.iW < r.sW / 2 ? r.sW / 2 - n * r.iW : r.dX;
                    r.dX = r.dX > r.sW / 2 ? r.sW / 2 : r.dX
                }
            }
            if (t !== "") {
                r.dY = t + r.transOffY;
                if (r.pan_limit) {
                    r.dY = r.dY + n * r.iH < r.sH ? r.sH - n * r.iH : r.dY;
                    r.dY = r.dY > 0 ? 0 : r.dY;
                    if (n * r.iH < r.sH) {
                        r.dY = (r.sH - n * r.iH) / 2
                    }
                } else {
                    r.dY = r.dY + n * r.iH < r.sH / 2 ? r.sH / 2 - n * r.iH : r.dY;
                    r.dY = r.dY > r.sH / 2 ? r.sH / 2 : r.dY
                }
            }
        },
        Animate: function() {
            var e = this;
            var t = .5;
            e.cFlag._nd = true;
            e.ani_end = false;
            if (e.cFlag._zi) {
                if (!e._wheel && !e.zoom_single) {
                    e.rA *= e.zoom_speed
                }
                if (e.rA > e.zoom_max) {
                    e.rA = e.zoom_max
                }
                e.cFlag._nd = false;
                e.cFlag._rs = false;
                e._recent = "zoomIn";
                e._onfocus = e._dragging = false
            }
            if (e.cFlag._zo) {
                if (!e._wheel && !e.zoom_single) {
                    e.rA /= e.zoom_speed
                }
                if (e.zoom_min != 0) {
                    if (e.rA < e.zoom_min) {
                        e.rA = e.zoom_min
                    }
                } else {
                    if (e.rA < e.rF) {
                        e.rA = e.rF
                    }
                }
                e.cFlag._nd = false;
                e.cFlag._rs = false;
                e._recent = "zoomOut";
                e._onfocus = e._dragging = false
            }
            if (e.zoom_single && !e.cFlag._rs) {
                if (e._recent == "zoomIn") {
                    e.sRed += (10 - e.sRed) / 6;
                    e.rA += (e.zoom_max - e.rA) / (1 / (e.pan_speed_o + 1) * e.sRed + 1)
                } else if (e._recent == "zoomOut") {
                    e.sRed += (3 - e.sRed) / 3;
                    e.rA += (e.rF - e.rA) / ((1 / e.pan_speed_o + 1) * e.sRed + 1)
                }
            }
            e.pan_speed = (Math.max(1, 1 + (e.sW + e.sH) / 500) + e.pan_speed_o * e.pan_speed_o / 4) / Math.max(1, e.rA / 2);
            if (e.cFlag._ml) {
                e.oX -= e.pan_speed;
                e.cFlag._nd = false;
                e.cFlag._rs = false;
                e._recent = "left";
                e._onfocus = e._dragging = false
            }
            if (e.cFlag._mr) {
                e.oX += e.pan_speed;
                e.cFlag._nd = false;
                e.cFlag._rs = false;
                e._recent = "right";
                e._onfocus = e._dragging = false
            }
            if (e.cFlag._mu) {
                e.oY -= e.pan_speed;
                e.cFlag._nd = false;
                e.cFlag._rs = false;
                e._recent = "up";
                e._onfocus = e._dragging = false
            }
            if (e.cFlag._md) {
                e.oY += e.pan_speed;
                e.cFlag._nd = false;
                e.cFlag._rs = false;
                e._recent = "down";
                e._onfocus = e._dragging = false
            }
            if (e.cFlag._rs) {
                e.oX += (e.fX - e.oX) / 8;
                e.oY += (e.fY - e.oY) / 8;
                e.cFlag._nd = false;
                e._recent = "reset";
                e._onfocus = e._dragging = false
            }
            if (e.zoom_single && e._recent !== "reset") {
                if (e._onfocus) {
                    e._sc += (e.rA - e._sc) / e.reduction
                } else {
                    e._sc = e.rA
                }
            } else {
                e._sc += (e.rA - e._sc) / (e.ani_smooth / (e._onfocus ? e.reduction : 1))
            }
            e._w = e._sc * e.iW;
            e._h = e._sc * e.iH;
            if (e._dragging) {
                e.tX = e.dX;
                e.tY = e.dY;
                e.changeOffset(true, true)
            }
            if (e._recent == "zoomIn") {
                if (e._w > e.rA * e.iW - t && !e.zoom_single) {
                    if (e.cFlag._nd) {
                        e.ani_end = true
                    }
                    e._sc = e.rA
                } else if (e._w > e.zoom_max * e.iW - t && e.zoom_single) {
                    if (e.cFlag._nd) {
                        e.ani_end = true
                    }
                    e._sc = e.rA = e.zoom_max
                }
                if (e.ani_end) {
                    e._w = e._sc * e.iW;
                    e._h = e._sc * e.iH
                }
            } else if (e._recent == "zoomOut") {
                if (e._w < e.rA * e.iW + t && !e.zoom_single) {
                    if (e.cFlag._nd) {
                        e.ani_end = true
                    }
                    e._sc = e.rA
                } else if (e._w < e.rF * e.iW + t && e.zoom_single) {
                    if (e.cFlag._nd) {
                        e.ani_end = true
                    }
                    e._sc = e.rA = e.rF
                }
                if (e.ani_end) {
                    e._w = e._sc * e.iW;
                    e._h = e._sc * e.iH
                }
            }
            e.limitX = (e._w - e.sW) / (e._w / e.sW) / 2;
            e.limitY = (e._h - e.sH) / (e._h / e.sH) / 2;
            if (!e._dragging) {
                if (e.pan_limit) {
                    if (e.oX < -e.limitX - e.focusOffX) {
                        e.oX = -e.limitX - e.focusOffX
                    }
                    if (e.oX > e.limitX - e.focusOffX) {
                        e.oX = e.limitX - e.focusOffX
                    }
                    if (e._w < e.sW) {
                        e.tX = (e.sW - e._w) / 2;
                        e.changeOffset(true, false)
                    }
                    if (e.oY < -e.limitY - e.focusOffY) {
                        e.oY = -e.limitY - e.focusOffY
                    }
                    if (e.oY > e.limitY - e.focusOffY) {
                        e.oY = e.limitY - e.focusOffY
                    }
                    if (e._h < e.sH) {
                        e.tY = (e.sH - e._h) / 2;
                        e.changeOffset(false, true)
                    }
                } else {
                    if (e.oX < -e.limitX - e.focusOffX / e._w * e.sW - e.sW / 2 / (e._w / e.sW)) {
                        e.oX = -e.limitX - e.focusOffX / e._w * e.sW - e.sW / 2 / (e._w / e.sW)
                    }
                    if (e.oX > e.limitX - e.focusOffX / e._w * e.sW + e.sW / 2 / (e._w / e.sW)) {
                        e.oX = e.limitX - e.focusOffX / e._w * e.sW + e.sW / 2 / (e._w / e.sW)
                    }
                    if (e.oY < -e.limitY - e.focusOffY / e._h * e.sH - e.sH / (e._h / e.sH * 2)) {
                        e.oY = -e.limitY - e.focusOffY / e._h * e.sH - e.sH / (e._h / e.sH * 2)
                    }
                    if (e.oY > e.limitY - e.focusOffY / e._h * e.sH + e.sH / (e._h / e.sH * 2)) {
                        e.oY = e.limitY - e.focusOffY / e._h * e.sH + e.sH / (e._h / e.sH * 2)
                    }
                }
            }
            if (!e._dragging && e._recent != "drag") {
                e.tX = (e.sW - e._w) / 2 + e.focusOffX + e.oX * (e._w / e.sW);
                e.tY = (e.sH - e._h) / 2 + e.focusOffY + e.oY * (e._h / e.sH);
                if (e.ani_smooth === 1) {
                    e.cFlag._nd = true;
                    e.ani_end = true
                }
            }
            if (e._recent == "zoomIn" || e._recent == "zoomOut" || e.cFlag._rs) {
                e._x = e.tX;
                e._y = e.tY
            } else {
                e._x += (e.tX - e._x) / (e.ani_smooth / (e._onfocus ? e.reduction : 1));
                e._y += (e.tY - e._y) / (e.ani_smooth / (e._onfocus ? e.reduction : 1))
            }
            if (e._recent == "left") {
                if (e._x < e.tX + t || e.ani_smooth === 1) {
                    e.cFlag._nd ? e.ani_end = true : "";
                    e._recent = "";
                    e._x = e.tX
                }
            } else if (e._recent == "right") {
                if (e._x > e.tX - t || e.ani_smooth === 1) {
                    e.cFlag._nd ? e.ani_end = true : "";
                    e._recent = "";
                    e._x = e.tX
                }
            } else if (e._recent == "up") {
                if (e._y < e.tY + t || e.ani_smooth === 1) {
                    e.cFlag._nd ? e.ani_end = true : "";
                    e._recent = "";
                    e._y = e.tY
                }
            } else if (e._recent == "down") {
                if (e._y > e.tY - t || e.ani_smooth === 1) {
                    e.cFlag._nd ? e.ani_end = true : "";
                    e._recent = "";
                    e._y = e.tY
                }
            } else if (e._recent == "drag") {
                if (e._x + t >= e.tX && e._x - t <= e.tX && e._y + t >= e.tY && e._y - t <= e.tY || e.ani_smooth === 1) {
                    if (e._onfocus) {
                        e._dragging = false
                    }
                    e.cFlag._nd ? e.ani_end = true : "";
                    e._recent = "";
                    e._x = e.tX;
                    e._y = e.tY
                }
            }
            if (e.cFlag._rs && e._w + t >= e.rA * e.iW && e._w - t <= e.rA * e.iW && e.oX <= e.fX + t && e.oX >= e.fX - t && e.oY <= e.fY + t && e.oY >= e.fY - t) {
                e.ani_end = true;
                e._recent = "";
                e.cFlag._rs = false;
                e.cFlag._nd = true;
                e._x = e.tX;
                e._y = e.tY;
                e._sc = e.rA;
                e._w = e._sc * e.iW;
                e._h = e._sc * e.iH
            }
            if (e.rA == e.rF && e.iW * e.rA <= e.sW && e.iH * e.rA <= e.sH) {
                if (e.buttons[1].$ob.css("opacity") > .5) {
                    if (e.rA >= e.rF && (e.init_zoom == "" || e.rA < e.init_zoom) && (e.zoom_min == "" || e.rA < e.zoom_min)) {
                        if (e.pan_limit && e._moveCursor && !e._moveCursor) {
                            e.$image.css("cursor", "default");
                            e.$hitArea.css("cursor", "default")
                        }
                        for (var n = 1; n < (e.pan_limit && !e._moveCursor ? e.buttons_total : 2); n++) {
                            e.buttons[n].$ob.css({
                                opacity: .4
                            });
                            e._wheel = false;
                            e.$holder.find("#" + e.buttons[n]._var + "norm").show();
                            e.$holder.find("#" + e.buttons[n]._var + "over").hide()
                        }
                    }
                }
            } else {
                if (e.buttons[1].$ob.css("opacity") < .5) {
                    if (e._moveCursor && e.mouse_drag) {
                        e.$image.css("cursor", "move");
                        e.$hitArea.css("cursor", "move")
                    }
                    for (var n = 1; n < e.buttons_total; n++) {
                        e.buttons[n].$ob.css("opacity", .7)
                    }
                }
            }
            if (e.rA == e.zoom_max) {
                if (e.buttons[0].$ob.css("opacity") > .5) {
                    e.buttons[0].$ob.css("opacity", .4);
                    e._wheel = false;
                    e.$holder.find("#" + e.buttons[0]._var + "norm").show();
                    e.$holder.find("#" + e.buttons[0]._var + "over").hide()
                }
            } else {
                if (e.buttons[0].$ob.css("opacity") < .5) {
                    e.buttons[0].$ob.css("opacity", .7)
                }
            }
            if (o) {
                e.$image.css(o, "translate(" + e._x.toFixed(14) + "px," + e._y.toFixed(14) + "px) scale(" + e._sc + ")")
            } else {
                e.$image.css({
                    left: e._x,
                    top: e._y,
                    width: e._w,
                    height: e._h
                })
            }
            if (e.$loc_cont) {
                e.updateLocations(e._x, e._y, e._sc, e.locations)
            }
            if (!o && e.map_coordinates.length > 0) {
                e.updateMap()
            }
            if (e.ani_end && !e._dragging && e._recent != "drag") {
                e._playing = false;
                e._recent = "";
                e.cX = (-e._x + e.sW / 2) / e.rA;
                e.cY = (-e._y + e.sH / 2) / e.rA;
                if (e.onUPDATE) {
                    e.onUPDATE(e.getZoomData(), false)
                }
                if (e.onZOOM_PAN) {
                    e.onZOOM_PAN(e.getZoomData())
                }
                clearTimeout(e.ani_timer)
            } else {
                e._playing = true;
                if (e.onUPDATE) {
                    e.onUPDATE(e.getZoomData(), true)
                }
                e.ani_timer = setTimeout(function() {
                    e.Animate()
                }, 28)
            }
        },
        updateLocations: function(t, n, r, i) {
            if (this.onLANDMARK !== "") {
                if (r >= this.show_at_zoom) {
                    if (!this._landmark) {
                        this._landmark = true;
                        this.onLANDMARK(true)
                    }
                } else {
                    if (this._landmark) {
                        this._landmark = false;
                        this.onLANDMARK(false)
                    }
                }
            }
            for (var s = 0; s < i.length; s++) {
                var u, a, f = i[s].x * r + t,
                    l = i[s].y * r + n;
                if (r >= i[s].showAt) {
                    if (i[s].scale && o) {
                        u = i[s].w2pad * this._sc;
                        a = i[s].h2 * this._sc
                    } else {
                        u = i[s].w2pad;
                        a = i[s].h2
                    }
                    if (f > -u && f < this.sW + u && (l > -a && l < this.sH + a && i[s].lab || l > 0 && l < this.sH + a * 2 && !i[s].lab)) {
                        if (!i[s].vis) {
                            i[s].vis = true;
                            if (o) {
                                i[s].ob.stop().css("display", "block").animate({
                                    opacity: 1
                                }, 300)
                            } else {
                                i[s].ob.show()
                            }
                        }
                    } else {
                        if (i[s].vis) {
                            i[s].vis = false;
                            if (o) {
                                i[s].ob.stop().animate({
                                    opacity: 0
                                }, 200, function() {
                                    e(this).hide()
                                })
                            } else {
                                i[s].ob.hide()
                            }
                        }
                    }
                } else {
                    if (i[s].vis) {
                        i[s].vis = false;
                        if (o) {
                            i[s].ob.stop().animate({
                                opacity: 0
                            }, 200, function() {
                                e(this).hide()
                            })
                        } else {
                            i[s].ob.hide()
                        }
                    }
                }
                if (f !== i[s].lpx || l !== i[s].lpy && i[s].vis) {
                    if (o) {
                        i[s].ob.css(o, "translate(" + f.toFixed(14) + "px," + l.toFixed(14) + "px)" + (i[s].scale ? " scale(" + this._sc + ")" : ""))
                    } else {
                        i[s].ob.css({
                            left: f,
                            top: l
                        })
                    }
                }
                i[s].lpx = f;
                i[s].lpy = l
            }
        },
        roundBG: function(t, n, r, i, s, o, u, a, f, l) {
            var c = 50 / 2;
            t.append(e('<div class="bgi' + n + '" style="background-position:' + -(o - s) + "px " + (-(c - s) - l) + 'px"></div>				<div class="bgh' + n + '"></div>				<div class="bgi' + n + '" style="background-position:' + -o + "px " + (-(c - s) - l) + "px; left:" + (r - s) + 'px"></div>				<div class="bgi' + n + '" style="background-position:' + -(o - s) + "px " + (-c - l) + "px; top:" + (i - s) + 'px"></div>				<div class="bgh' + n + '" style = "top:' + (i - s) + "px; left:" + s + 'px"></div>				<div class="bgi' + n + '" style="background-position:' + -o + "px " + (-c - l) + "px; top:" + (i - s) + "px; left:" + (r - s) + 'px"></div>				<div class="bgc' + n + '"></div>'));
            e(".bgi" + n).css({
                position: "absolute",
                width: s,
                height: s,
                "background-image": "url(" + a + ")",
                "background-repeat": "no-repeat",
                "-ms-filter": "progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)",
                filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)",
                zoom: 1
            });
            e(".bgh" + n).css({
                position: "absolute",
                width: r - s * 2,
                height: s,
                "background-color": u,
                left: s
            });
            e(".bgc" + n).css({
                position: "absolute",
                width: r,
                height: i - s * 2,
                "background-color": u,
                top: s,
                left: 0
            })
        },
        changeOffset: function(e, t) {
            if (e) this.oX = (this.tX - (this.sW - this._w) / 2 - this.focusOffX) / (this._w / this.sW);
            if (t) this.oY = (this.tY - (this.sH - this._h) / 2 - this.focusOffY) / (this._h / this.sH)
        },
        updateMap: function() {
            var t = this,
                n = 0;
            t.mapAreas.each(function() {
                var r = [];
                for (var i = 0; i < t.map_coordinates[n].length; i++) {
                    r[i] = t.map_coordinates[n][i] * t._sc
                }
                r = r.join(",");
                e(this).attr("coords", r);
                n++
            })
        },
        haltAnimation: function() {
            clearTimeout(this.ani_timer);
            this._playing = false;
            this._recent = ""
        },
        destroy: function() {
            var r = this;
            if (r.assetsLoaded) {
                r.haltAnimation();
                for (prop in r.orig_style) {
                    if (r.orig_style[prop][0] !== false && r.orig_style[prop][0] !== undefined) {
                        if (r.orig_style[prop][0] === "width" || r.orig_style[prop][0] === "height") {
                            if (parseInt(r.orig_style[prop][1]) !== 0) {
                                r.$image.css(r.orig_style[prop][0], r.orig_style[prop][1])
                            }
                        } else {
                            r.$image.css(r.orig_style[prop][0], r.orig_style[prop][1])
                        }
                    }
                }
                clearTimeout(r.auto_timer);
                e(n).unbind(".sz" + r.id);
                e(t).unbind(".sz" + r.id);
                r.$holder.unbind(".sz");
                r.$controls = undefined
            } else {
                r.$image.show()
            }
            if (r.container == "") {
                if (r.image_url == "") {
                    r.$image.insertBefore(r.$holder);
                    if (r.$holder !== undefined) {
                        r.$holder.remove()
                    }
                } else {
                    r.$elem.empty();
                    if (r.$loc_cont[0]) {
                        r.$elem.append(r.loc_clone)
                    }
                }
            } else {
                r.$image.insertBefore(r.$holder);
                r.$holder.empty();
                r.$image.wrap(r.$holder);
                if (r.$loc_cont[0]) {
                    r.$holder.append(r.loc_clone)
                }
            }
            r.$elem.removeData("smoothZoom");
            r.$holder = undefined;
            r.Buttons = undefined;
            r.op = undefined;
            r.$image = undefined
        },
        focusTo: function(e) {
            var t = this;
            if (t.assetsLoaded) {
                if (e.zoom === undefined || e.zoom === "" || e.zoom == 0) {
                    e.zoom = t.rA
                } else {
                    e.zoom /= 100
                }
                t._onfocus = true;
                if (e.zoom > t.rA && t.rA != t.zoom_max) {
                    t.rA = e.zoom;
                    t.rA = t.rA > t.zoom_max ? t.zoom_max : t.rA
                } else if (e.zoom < t.rA && t.rA != t.rF) {
                    t.rA = e.zoom;
                    t.rA = t.rA < t.rF ? t.rF : t.rA
                }
                t.transOffX = t.transOffY = 0;
                t.setDraggedPos(e.x === undefined || e.x === "" ? "" : -e.x * t.rA + t.sW / 2, e.y === undefined || e.y === "" ? "" : -e.y * t.rA + t.sH / 2, t.rA);
                t.reduction = e.speed ? e.speed / 10 : t.focusSpeed;
                t._recent = "drag";
                t._dragging = true;
                if (!t._playing) {
                    t.Animate()
                }
            }
        },
        zoomIn: function(e) {
            this.buttons[0].$ob.trigger(this.event_down, {
                id: 0
            })
        },
        zoomOut: function(e) {
            this.buttons[1].$ob.trigger(this.event_down, {
                id: 1
            })
        },
        moveRight: function(e) {
            this.buttons[2].$ob.trigger(this.event_down, {
                id: 2
            })
        },
        moveLeft: function(e) {
            this.buttons[3].$ob.trigger(this.event_down, {
                id: 3
            })
        },
        moveUp: function(e) {
            this.buttons[4].$ob.trigger(this.event_down, {
                id: 4
            })
        },
        moveDown: function(e) {
            this.buttons[5].$ob.trigger(this.event_down, {
                id: 5
            })
        },
        Reset: function(e) {
            this.buttons[6].$ob.trigger(this.event_down, {
                id: 6
            })
        },
        getZoomData: function(e) {
            return {
                normX: (-this._x / this.rA).toFixed(14),
                normY: (-this._y / this.rA).toFixed(14),
                normWidth: this.iW,
                normHeight: this.iH,
                scaledX: -this._x.toFixed(14),
                scaledY: -this._y.toFixed(14),
                scaledWidth: this._w,
                scaledHeight: this._h,
                centerX: (-this._x.toFixed(14) + this.sW / 2) / this.rA,
                centerY: (-this._y.toFixed(14) + this.sH / 2) / this.rA,
                ratio: this.rA
            }
        },
        addLandmark: function(t) {
            if (this.$loc_cont) {
                var n = t.length;
                for (var r = 0; r < n; r++) {
                    var i = e(t[r]);
                    this.$loc_cont.append(i);
                    this.setLocation(i)
                }
                if (n > 0) {
                    this.updateLocations(this._x, this._y, this._sc, this.locations)
                }
            }
        },
        attachLandmark: function(t) {
            if (this.$loc_cont) {
                var n = t.length;
                for (var r = 0; r < n; r++) {
                    this.setLocation(t[r] instanceof jQuery ? t[r] : e("#" + t[r]))
                }
                if (n > 0) {
                    this.updateLocations(this._x, this._y, this._sc, this.locations)
                }
            }
        },
        removeLandmark: function(e) {
            if (this.$loc_cont) {
                if (e) {
                    var t = e.length;
                    for (var n = 0; n < t; n++) {
                        for (var r = 0; r < this.locations.length; r++) {
                            if (e[n] instanceof jQuery && this.locations[r].ob[0] == e[n][0] || !(e[n] instanceof jQuery) && this.locations[r].ob.attr("id") == e[n]) {
                                this.locations[r].ob.remove();
                                this.locations.splice(r, 1);
                                r--
                            }
                        }
                    }
                } else {
                    if (this.locations.length > 0) {
                        this.locations[this.locations.length - 1].ob.remove();
                        this.locations.pop()
                    }
                }
                if (t > 0) {
                    this.updateLocations(this._x, this._y, this._sc, this.locations)
                }
            }
        },
        refreshAllLandmarks: function() {
            var t = this;
            var n = t.$loc_cont.children(".item");
            t.show_at_zoom = parseInt(t.$loc_cont.data("show-at-zoom"), 10) / 100;
            t.allow_scale = s(t.$loc_cont.data("allow-scale"));
            t.allow_drag = s(t.$loc_cont.data("allow-drag"));
            for (var r = 0; r < t.locations.length; r++) {
                var i = false;
                n.each(function() {
                    if (t.locations[r].ob[0] == e(this)[0]) {
                        i = true
                    }
                });
                if (!i) {
                    t.locations.splice(r, 1);
                    r--
                }
            }
            n.each(function() {
                var n = false;
                for (var r = 0; r < t.locations.length; r++) {
                    if (t.locations[r].ob[0] == e(this)[0]) {
                        n = true;
                        break
                    }
                }
                if (!n) {
                    t.setLocation(e(this))
                }
            });
            this.updateLocations(this._x, this._y, this._sc, this.locations)
        },
        resize: function(e) {
            var t;
            if (e.data) {
                e.preventDefault();
                t = e.data.self;
                var n = t.$holder.parent().width();
                var r = t.$holder.parent().height();
                if (t.oW) {
                    n = Math.min(n, t.oW)
                }
                t.sW = n;
                if (t.oH) {
                    if (t.oW && t.maintain_ratio) {
                        t.sH = n / (t.oW / t.oH)
                    }
                } else {
                    t.sH = r
                }
            } else {
                t = this;
                if (e.width) {
                    t.sW = e.width
                }
                if (e.height) {
                    t.sH = e.height
                }
                if (e.max_WIDTH) {
                    t.w_max = e.max_WIDTH
                }
                if (e.max_HEIGHT) {
                    t.h_max = e.max_HEIGHT
                }
            }
            if (t.w_max !== 0 && t.w_max !== "") {
                t.sW = Math.min(t.sW, t.w_max)
            }
            if (t.h_max !== 0 && t.h_max !== "") {
                t.sH = Math.min(t.sH, t.h_max)
            }
            t.$holder.css({
                width: t.sW,
                height: t.sH
            });
            if (t.bord_size > 0) {
                t.border[0].height(t.sH);
                t.border[1].css({
                    height: t.sH,
                    left: t.sW - t.bord_size
                });
                t.border[2].width(t.sW - t.bord_size * 2);
                t.border[3].css({
                    width: t.sW - t.bord_size * 2,
                    top: t.sH - t.bord_size
                })
            }
            if (t.bu_align[1] == "center") {
                t.$controls.css("left", parseInt((t.sW - t.cBW) / 2))
            }
            if (t.bu_align[0] == "center") {
                t.$controls.css("top", parseInt((t.sH - t.cBH) / 2))
            }
            t.rF = t.rR = t.checkRatio(t.sW, t.sH, t.iW, t.iH, t.zoom_fit);
            if (t.zoom_min == 0) {
                if (t.rA < t.rF) {
                    t.rA = t.rF
                }
            }
            t.focusTo({
                x: t.cX,
                y: t.cY,
                zoom: "",
                speed: 10
            })
        }
    };
    e.fn.z = function(t) {
        var n = this;
        var r = n.length;
        for (var s = 0; s < r; s++) {
            var o = e(n[s]);
            var u = o.data("smoothZoom");
            if (!u) {
                if (typeof t === "object" || !t) {
                    o.data("smoothZoom", new i(o, t))
                }
            } else {
                if (t == "getZoomData") {
                    return u[t].apply(u, Array.prototype.slice.call(arguments, 1))
                } else if (u[t]) {
                    u[t].apply(u, Array.prototype.slice.call(arguments, 1))
                }
            }
        }
        if (t !== "getZoomData") {
            return this
        }
    };
    t.Modernizr = function(e, t, n) {
        function r(e) {
            v.cssText = e
        }

        function i(e, t) {
            return r(y.join(e + ";") + (t || ""))
        }

        function s(e, t) {
            return typeof e === t
        }

        function o(e, t) {
            return !!~("" + e).indexOf(t)
        }

        function u(e, t) {
            for (var r in e) {
                var i = e[r];
                if (!o(i, "-") && v[i] !== n) return t == "pfx" ? i : !0
            }
            return !1
        }

        function a(e, t, r) {
            for (var i in e) {
                var o = t[e[i]];
                if (o !== n) return r === !1 ? e[i] : s(o, "function") ? o.bind(r || t) : o
            }
            return !1
        }

        function f(e, t, n) {
            var r = e.charAt(0).toUpperCase() + e.slice(1),
                i = (e + " " + w.join(r + " ") + r).split(" ");
            return s(t, "string") || s(t, "undefined") ? u(i, t) : (i = (e + " " + E.join(r + " ") + r).split(" "), a(i, t, n))
        }
        var l = "2.8.2",
            c = {},
            h = t.documentElement,
            p = "modernizr",
            d = t.createElement(p),
            v = d.style,
            m, g = {}.toString,
            y = " -webkit- -moz- -o- -ms- ".split(" "),
            b = "Webkit Moz O ms",
            w = b.split(" "),
            E = b.toLowerCase().split(" "),
            S = {},
            x = {},
            T = {},
            N = [],
            C = N.slice,
            k, L = function(e, n, r, i) {
                var s, o, u, a, f = t.createElement("div"),
                    l = t.body,
                    c = l || t.createElement("body");
                if (parseInt(r, 10))
                    while (r--) u = t.createElement("div"), u.id = i ? i[r] : p + (r + 1), f.appendChild(u);
                return s = ["&#173;", '<style id="s', p, '">', e, "</style>"].join(""), f.id = p, (l ? f : c).innerHTML += s, c.appendChild(f), l || (c.style.background = "", c.style.overflow = "hidden", a = h.style.overflow, h.style.overflow = "hidden", h.appendChild(c)), o = n(f, e), l ? f.parentNode.removeChild(f) : (c.parentNode.removeChild(c), h.style.overflow = a), !!o
            },
            A = {}.hasOwnProperty,
            O;
        !s(A, "undefined") && !s(A.call, "undefined") ? O = function(e, t) {
            return A.call(e, t)
        } : O = function(e, t) {
            return t in e && s(e.constructor.prototype[t], "undefined")
        }, Function.prototype.bind || (Function.prototype.bind = function(e) {
            var t = this;
            if (typeof t != "function") throw new TypeError;
            var n = C.call(arguments, 1),
                r = function() {
                    if (this instanceof r) {
                        var i = function() {};
                        i.prototype = t.prototype;
                        var s = new i,
                            o = t.apply(s, n.concat(C.call(arguments)));
                        return Object(o) === o ? o : s
                    }
                    return t.apply(e, n.concat(C.call(arguments)))
                };
            return r
        }), S.borderradius = function() {
            return f("borderRadius")
        }, S.csstransforms = function() {
            return !!f("transform")
        }, S.csstransforms3d = function() {
            var e = !!f("perspective");
            return e && "webkitPerspective" in h.style && L("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}", function(t, n) {
                e = t.offsetLeft === 9 && t.offsetHeight === 3
            }), e
        };
        for (var M in S) O(S, M) && (k = M.toLowerCase(), c[k] = S[M](), N.push((c[k] ? "" : "no-") + k));
        return c.addTest = function(e, t) {
            if (typeof e == "object")
                for (var r in e) O(e, r) && c.addTest(r, e[r]);
            else {
                e = e.toLowerCase();
                if (c[e] !== n) return c;
                t = typeof t == "function" ? t() : t, typeof enableClasses != "undefined" && enableClasses && (h.className += " " + (t ? "" : "no-") + e), c[e] = t
            }
            return c
        }, r(""), d = m = null, c._version = l, c._prefixes = y, c._domPrefixes = E, c._cssomPrefixes = w, c.testProp = function(e) {
            return u([e])
        }, c.testAllProps = f, c.testStyles = L, c.prefixed = function(e, t, n) {
            return t ? f(e, t, n) : f(e, "pfx")
        }, c
    }(this, n);
    var o = Modernizr.prefixed("transform");
    var u = Modernizr.prefixed("transformOrigin");
    var a = Modernizr.prefixed("borderRadius");
    var f = Modernizr.csstransforms3d
})(jQuery, window, document);
! function(e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof exports ? module.exports = e : e(jQuery)
}(function(e) {
    function t(t) {
        var o = t || window.event,
            u = a.call(arguments, 1),
            f = 0,
            h = 0,
            p = 0,
            v = 0,
            m = 0,
            g = 0;
        if (t = e.event.fix(o), t.type = "mousewheel", "detail" in o && (p = -1 * o.detail), "wheelDelta" in o && (p = o.wheelDelta), "wheelDeltaY" in o && (p = o.wheelDeltaY), "wheelDeltaX" in o && (h = -1 * o.wheelDeltaX), "axis" in o && o.axis === o.HORIZONTAL_AXIS && (h = -1 * p, p = 0), f = 0 === p ? h : p, "deltaY" in o && (p = -1 * o.deltaY, f = p), "deltaX" in o && (h = o.deltaX, 0 === p && (f = -1 * h)), 0 !== p || 0 !== h) {
            if (1 === o.deltaMode) {
                var y = e.data(this, "mousewheel-line-height");
                f *= y, p *= y, h *= y
            } else if (2 === o.deltaMode) {
                var b = e.data(this, "mousewheel-page-height");
                f *= b, p *= b, h *= b
            }
            if (v = Math.max(Math.abs(p), Math.abs(h)), (!s || s > v) && (s = v, r(o, v) && (s /= 40)), r(o, v) && (f /= 40, h /= 40, p /= 40), f = Math[f >= 1 ? "floor" : "ceil"](f / s), h = Math[h >= 1 ? "floor" : "ceil"](h / s), p = Math[p >= 1 ? "floor" : "ceil"](p / s), l.settings.normalizeOffset && this.getBoundingClientRect) {
                var w = this.getBoundingClientRect();
                m = t.clientX - w.left, g = t.clientY - w.top
            }
            return t.deltaX = h, t.deltaY = p, t.deltaFactor = s, t.offsetX = m, t.offsetY = g, t.deltaMode = 0, u.unshift(t, f, h, p), i && clearTimeout(i), i = setTimeout(n, 200), (e.event.dispatch || e.event.handle).apply(this, u)
        }
    }

    function n() {
        s = null
    }

    function r(e, t) {
        return l.settings.adjustOldDeltas && "mousewheel" === e.type && t % 120 === 0
    }
    var i, s, o = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
        u = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
        a = Array.prototype.slice;
    if (e.event.fixHooks)
        for (var f = o.length; f;) e.event.fixHooks[o[--f]] = e.event.mouseHooks;
    var l = e.event.special.mousewheel = {
        version: "3.1.11",
        setup: function() {
            if (this.addEventListener)
                for (var n = u.length; n;) this.addEventListener(u[--n], t, !1);
            else this.onmousewheel = t;
            e.data(this, "mousewheel-line-height", l.getLineHeight(this)), e.data(this, "mousewheel-page-height", l.getPageHeight(this))
        },
        teardown: function() {
            if (this.removeEventListener)
                for (var n = u.length; n;) this.removeEventListener(u[--n], t, !1);
            else this.onmousewheel = null;
            e.removeData(this, "mousewheel-line-height"), e.removeData(this, "mousewheel-page-height")
        },
        getLineHeight: function(t) {
            var n = e(t)["offsetParent" in e.fn ? "offsetParent" : "parent"]();
            return n.length || (n = e("body")), parseInt(n.css("fontSize"), 10)
        },
        getPageHeight: function(t) {
            return e(t).height()
        },
        settings: {
            adjustOldDeltas: !0,
            normalizeOffset: !0
        }
    };
    e.fn.extend({
        mousewheel: function(e) {
            return e ? this.bind("mousewheel", e) : this.trigger("mousewheel")
        },
        unmousewheel: function(e) {
            return this.unbind("mousewheel", e)
        }
    })
});
var ani_smooth;
var zoom_speed;
var pan_speed;
jQuery(function(e) {
    var t = e(document);
    var n = e("#cont");
    var r = e("#settings");
    r.addClass("noSel");
    var i = e("#barSmooth").css({
        left: smPos + "px"
    });
    var s = e("#barSmooth_t").css({
        left: smPos - 3 + "px",
        "-moz-user-select": "none",
        "-khtml-user-select": "none",
        "-webkit-user-select": "none",
        "user-select": "none",
        cursor: "default"
    }).addClass("noSel").hide();
    var o = false;
    i.bind("mouseover", function(e) {
        i.css("background-position", "-1025px 0px");
        if (!f) s.show()
    }).bind("mouseout", function(e) {
        if (!o) i.css("background-position", "-1011px 0px"), s.hide()
    }).bind("mousedown", function(e) {
        o = true;
        s.show();
        i.css("background-position", "-1025px 0px");
        offX = e.pageX - r.offset().left - i.position().left;
        t.bind("mousemove.preview", function(e) {
            var t = e.pageX - r.offset().left - offX;
            t < 112 ? t = 108 : "";
            t > 194 ? t = 198 : "";
            t > 148 && t < 158 ? t = 153 : "";
            i.css({
                left: t + "px"
            });
            s.css({
                left: t - 3 + "px"
            });
            var n = setSmooth(i.position().left);
            setLable(s, n);
            return false
        });
        var n = setSmooth(i.position().left);
        setLable(s, n);
        e.stopPropagation();
        if (e.preventDefault) e.preventDefault()
    }).addClass("noSel");
    i.bind("touchstart.preview", function(e) {
        e.preventDefault();
        offX = e.originalEvent.changedTouches[0].pageX - r.offset().left - i.position().left;
        o = true;
        var t = setSmooth(i.position().left);
        setLable(s, t);
        i.css("background-position", "-1025px 0px");
        s.show()
    });
    var u = e("#barSpeed").css({
        left: spPos + "px"
    });
    var a = e("#barSpeed_t").css({
        left: spPos - 3 + "px",
        "-moz-user-select": "none",
        "-khtml-user-select": "none",
        "-webkit-user-select": "none",
        "user-select": "none",
        cursor: "default"
    }).addClass("noSel").hide();
    var f = false;
    u.bind("mouseover", function(e) {
        u.css("background-position", "-1025px 0px");
        if (!o) a.show()
    }).bind("mouseout", function(e) {
        if (!f) u.css("background-position", "-1011px 0px"), a.hide()
    }).bind("mousedown", function(e) {
        f = true;
        a.show();
        u.css("background-position", "-1025px 0px");
        offX = e.pageX - r.offset().left - u.position().left;
        t.bind("mousemove.preview", function(e) {
            var t = e.pageX - r.offset().left - offX;
            t < 112 ? t = 108 : "";
            t > 194 ? t = 198 : "";
            t > 148 && t < 158 ? t = 153 : "";
            u.css({
                left: t + "px"
            });
            a.css({
                left: t - 3 + "px"
            });
            var n = setSpeed(u.position().left);
            setLable(a, n);
            return false
        });
        var n = setSpeed(u.position().left);
        setLable(a, n);
        e.stopPropagation();
        if (e.preventDefault) e.preventDefault()
    }).addClass("noSel");
    u.bind("touchstart.preview", function(e) {
        e.preventDefault();
        offX = e.originalEvent.changedTouches[0].pageX - r.offset().left - u.position().left;
        f = true;
        var t = setSmooth(u.position().left);
        setLable(a, t);
        u.css("background-position", "-1011px 0px");
        a.show()
    });
    t.bind("mouseup.preview", function(e) {
        if (o) {
            o = false;
            s.hide();
            t.unbind("mousemove.preview");
            var n = e.pageX - r.offset().left - offX;
            n < 112 ? n = 108 : "";
            n > 194 ? n = 198 : "";
            n > 148 && n < 158 ? n = 153 : "";
            i.css({
                left: n + "px"
            });
            s.css({
                left: n - 3 + "px"
            });
            l = setSmooth(i.position().left);
            setLable(s, l);
            i.css("background-position", "-1011px 0px")
        }
        if (f) {
            f = false;
            a.hide();
            t.unbind("mousemove.preview");
            var n = e.pageX - r.offset().left - offX;
            n < 112 ? n = 108 : "";
            n > 194 ? n = 198 : "";
            n > 148 && n < 158 ? n = 153 : "";
            u.css({
                left: n + "px"
            });
            a.css({
                left: n - 3 + "px"
            });
            var l = setSpeed(u.position().left);
            setLable(a, l);
            u.css("background-position", "-1011px 0px")
        }
    });
    n.bind("touchmove.preview", function(e) {
        e.preventDefault();
        if (o) {
            var t = e.originalEvent.changedTouches[0].pageX - r.offset().left - offX;
            t < 112 ? t = 108 : "";
            t > 194 ? t = 198 : "";
            t > 148 && t < 158 ? t = 153 : "";
            i.css({
                left: t + "px"
            });
            s.css({
                left: t - 3 + "px"
            });
            var n = setSmooth(i.position().left);
            setLable(s, n)
        }
        if (f) {
            var t = e.originalEvent.changedTouches[0].pageX - r.offset().left - offX;
            t < 112 ? t = 108 : "";
            t > 194 ? t = 198 : "";
            t > 148 && t < 158 ? t = 153 : "";
            u.css({
                left: t + "px"
            });
            a.css({
                left: t - 3 + "px"
            });
            var n = setSpeed(u.position().left);
            setLable(a, n)
        }
    });
    n.bind("touchend.preview", function(e) {
        e.preventDefault();
        if (o) {
            o = false;
            s.hide();
            setSmooth((i.position().left - 108) / 100 * 10);
            i.css("background-position", "-1011px 0px")
        }
        if (f) {
            f = false;
            a.hide();
            setSpeed((u.position().left - 108) / 100 * 10);
            u.css("background-position", "-1011px 0px")
        }
    });
    e("#cont").addClass("noSel");
    e(".noSel").each(function() {
        this.onselectstart = function() {
            return false
        }
    });
    e("#s" + sample).css({
        "background-position": (sample - 1) * -111 + "px -44px",
        cursor: "pointer"
    });
    e("#s1").bind("mouseover", function(t) {
        if (sample !== 1) e(this).css({
            "background-position": "0px -22px",
            cursor: "pointer"
        })
    }).bind("mouseout", function(t) {
        if (sample !== 1) e(this).css({
            "background-position": "0px 0px",
            cursor: "default"
        })
    }).bind("click", function(t) {
        if (sample !== 1) e(this).css("background-position", "0px -44px"), e("#s2").css("background-position", "-111px 0px"), e("#s3").css("background-position", "-222px 0px"), e("#s4").css("background-position", "-333px 0px"), e("#s5").css("background-position", "-444px 0px"), e("#s6").css("background-position", "-555px 0px"), e("#s7").css("background-position", "-666px 0px"), sample = 1
    });
    e("#s2").bind("mouseover", function(t) {
        if (sample !== 2) e(this).css({
            "background-position": "-111px -22px",
            cursor: "pointer"
        })
    }).bind("mouseout", function(t) {
        if (sample !== 2) e(this).css({
            "background-position": "-111px 0px",
            cursor: "default"
        })
    }).bind("click", function(t) {
        if (sample !== 2) e(this).css("background-position", "-111px -44px"), e("#s1").css("background-position", "0px 0px"), e("#s3").css("background-position", "-222px 0px"), e("#s4").css("background-position", "-333px 0px"), e("#s5").css("background-position", "-444px 0px"), e("#s6").css("background-position", "-555px 0px"), e("#s7").css("background-position", "-666px 0px"), sample = 2
    });
    e("#s3").bind("mouseover", function(t) {
        if (sample !== 3) e(this).css({
            "background-position": "-222px -22px",
            cursor: "pointer"
        })
    }).bind("mouseout", function(t) {
        if (sample !== 3) e(this).css({
            "background-position": "-222px 0px",
            cursor: "default"
        })
    }).bind("click", function(t) {
        if (sample !== 3) e(this).css("background-position", "-222px -44px"), e("#s1").css("background-position", "0px 0px"), e("#s2").css("background-position", "-111px 0px"), e("#s4").css("background-position", "-333px 0px"), e("#s5").css("background-position", "-444px 0px"), e("#s6").css("background-position", "-555px 0px"), e("#s7").css("background-position", "-666px 0px"), sample = 3
    });
    e("#s4").bind("mouseover", function(t) {
        if (sample !== 4) e(this).css({
            "background-position": "-333px -22px",
            cursor: "pointer"
        })
    }).bind("mouseout", function(t) {
        if (sample !== 4) e(this).css({
            "background-position": "-333px 0px",
            cursor: "default"
        })
    }).bind("click", function(t) {
        if (sample !== 4) e(this).css("background-position", "-333px -44px"), e("#s1").css("background-position", "0px 0px"), e("#s2").css("background-position", "-111px 0px"), e("#s3").css("background-position", "-222px 0px"), e("#s5").css("background-position", "-444px 0px"), e("#s6").css("background-position", "-555px 0px"), e("#s7").css("background-position", "-666px 0px"), sample = 4
    });
    e("#s5").bind("mouseover", function(t) {
        if (sample !== 5) e(this).css({
            "background-position": "-444px -22px",
            cursor: "pointer"
        })
    }).bind("mouseout", function(t) {
        if (sample !== 5) e(this).css({
            "background-position": "-444px 0px",
            cursor: "default"
        })
    }).bind("click", function(t) {
        if (sample !== 5) e(this).css("background-position", "-444px -44px"), e("#s1").css("background-position", "0px 0px"), e("#s2").css("background-position", "-111px 0px"), e("#s3").css("background-position", "-222px 0px"), e("#s4").css("background-position", "-333px 0px"), e("#s6").css("background-position", "-555px 0px"), e("#s7").css("background-position", "-666px 0px"), sample = 5
    });
    e("#s6").bind("mouseover", function(t) {
        if (sample !== 6) e(this).css({
            "background-position": "-555px -22px",
            cursor: "pointer"
        })
    }).bind("mouseout", function(t) {
        if (sample !== 6) e(this).css({
            "background-position": "-555px 0px",
            cursor: "default"
        })
    }).bind("click", function(t) {
        if (sample !== 6) e(this).css("background-position", "-555px -44px"), e("#s1").css("background-position", "0px 0px"), e("#s2").css("background-position", "-111px 0px"), e("#s3").css("background-position", "-222px 0px"), e("#s4").css("background-position", "-333px 0px"), e("#s5").css("background-position", "-444px 0px"), e("#s7").css("background-position", "-666px 0px"), sample = 6
    });
    e("#s7").bind("mouseover", function(t) {
        if (sample !== 7) e(this).css({
            "background-position": "-666px -22px",
            cursor: "pointer"
        })
    }).bind("mouseout", function(t) {
        if (sample !== 7) e(this).css({
            "background-position": "-666px 0px",
            cursor: "default"
        })
    }).bind("click", function(t) {
        if (sample !== 7) e(this).css("background-position", "-666px -44px"), e("#s1").css("background-position", "0px 0px"), e("#s2").css("background-position", "-111px 0px"), e("#s3").css("background-position", "-222px 0px"), e("#s4").css("background-position", "-333px 0px"), e("#s5").css("background-position", "-444px 0px"), e("#s6").css("background-position", "-555px 0px"), sample = 7
    })
});