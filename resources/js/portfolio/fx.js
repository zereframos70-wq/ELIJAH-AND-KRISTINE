export function initializePortfolioEffects() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return () => {};
    }

    const fine = window.matchMedia('(hover:hover) and (pointer:fine)').matches;
    const controller = new AbortController();
    const timeouts = [];
    const cleanups = [];
    let disposed = false;

    curtain();
    splitHero();

    if (fine) {
        smoke();
        profile();
        magnet();
        spotlight();
    }

    /* ---------- Intro curtain (smooth page-load transition) ---------- */
    function curtain() {
        var c = document.createElement('div');
        c.className = 'fx-curtain';
        c.setAttribute('aria-hidden', 'true');
        c.innerHTML = '<span>ER<i>.</i></span>';
        document.body.appendChild(c);
        timeouts.push(
            setTimeout(function () {
                c.classList.add('out');
            }, 650),
        );
        timeouts.push(
            setTimeout(function () {
                c.remove();
            }, 1700),
        );
        cleanups.push(function () {
            c.remove();
        });
    }

    /* ---------- Hero headline: per-letter rise ---------- */
    function splitHero() {
        var h = document.getElementById('hero-title');

        if (!h) {
            return;
        }

        var originalMarkup = h.innerHTML;
        var originalAriaLabel = h.getAttribute('aria-label');
        var hadSplitClass = h.classList.contains('fx-split');
        cleanups.push(function () {
            h.innerHTML = originalMarkup;

            if (originalAriaLabel === null) {
                h.removeAttribute('aria-label');
            } else {
                h.setAttribute('aria-label', originalAriaLabel);
            }

            if (!hadSplitClass) {
                h.classList.remove('fx-split');
            }
        });

        h.setAttribute('aria-label', 'Elijah T. Ramos');
        h.classList.add('fx-split');
        var n = 0;
        function walk(node) {
            Array.prototype.slice.call(node.childNodes).forEach(function (ch) {
                if (ch.nodeType === 3) {
                    var frag = document.createDocumentFragment();
                    ch.textContent.split(/(\s+)/).forEach(function (w) {
                        if (!w) {
                            return;
                        }

                        if (/^\s+$/.test(w)) {
                            frag.appendChild(document.createTextNode(' '));

                            return;
                        }

                        var word = document.createElement('span');
                        word.className = 'fx-word';
                        word.setAttribute('aria-hidden', 'true');
                        w.split('').forEach(function (l) {
                            var s = document.createElement('span');
                            s.className = 'fx-ch';
                            s.textContent = l;
                            s.style.setProperty('--i', n++);
                            word.appendChild(s);
                        });
                        frag.appendChild(word);
                    });
                    node.replaceChild(frag, ch);
                } else if (ch.nodeType === 1 && ch.tagName !== 'BR') {
                    walk(ch);
                }
            });
        }
        walk(h);
    }

    /* ---------- Cursor smoke trail ---------- */
    function smoke() {
        var cv = document.createElement('canvas');
        cv.className = 'fx-smoke';
        cv.setAttribute('aria-hidden', 'true');
        document.body.appendChild(cv);
        var ctx = cv.getContext('2d'),
            dpr = Math.min(devicePixelRatio || 1, 1.5),
            W,
            H;
        function size() {
            W = innerWidth;
            H = innerHeight;
            cv.width = W * dpr;
            cv.height = H * dpr;
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        }
        size();
        window.addEventListener('resize', size, { signal: controller.signal });
        cleanups.push(function () {
            cv.remove();
        });

        function sprite(rgb) {
            var s = document.createElement('canvas');
            s.width = s.height = 64;
            var c = s.getContext('2d');
            var g = c.createRadialGradient(32, 32, 0, 32, 32, 32);
            g.addColorStop(0, 'rgba(' + rgb + ',1)');
            g.addColorStop(0.45, 'rgba(' + rgb + ',.45)');
            g.addColorStop(1, 'rgba(' + rgb + ',0)');
            c.fillStyle = g;
            c.fillRect(0, 0, 64, 64);

            return s;
        }
        var sprites = [
            sprite('85,167,131'),
            sprite('199,213,204'),
            sprite('36,118,83'),
            sprite('90,150,255'),
        ];
        var P = [],
            running = false,
            lx = null,
            ly = null,
            MAX = 140;
        var B = [],
            travel = 0,
            lastB = 0;
        var EM = [
            '85,167,131',
            '120,210,165',
            '235,255,244',
        ]; /* emerald bolts (passive) */
        var CH = [
            '70,130,255',
            '140,195,255',
            '245,250,255',
        ]; /* chidori blue-white */
        var charging = false,
            chg = 0,
            flash = null,
            glow = 0;

        /* Lightning: jagged random-walk path with a few forks */
        function path(x, y, ang, len, segs) {
            var pts = [[x, y]],
                step = len / segs;

            for (var i = 0; i < segs; i++) {
                ang += (Math.random() - 0.5) * 1.1;
                x += Math.cos(ang) * step;
                y += Math.sin(ang) * step;
                pts.push([x, y]);
            }

            return pts;
        }
        function bolt(x, y, ang, len, c, max, bp) {
            var main = path(x, y, ang, len, 8),
                lines = [main];

            for (var i = 2; i < main.length - 1; i++) {
                if (Math.random() < (bp || 0.28)) {
                    var q = main[i];
                    lines.push(
                        path(
                            q[0],
                            q[1],
                            ang +
                                (Math.random() < 0.5 ? -1 : 1) *
                                    (0.5 + Math.random() * 0.6),
                            len * 0.35,
                            4,
                        ),
                    );
                }
            }

            B.push({ l: lines, t: 0, max: max || 16, c: c || EM });
            lastB = performance.now();

            if (!running) {
                running = true;
                requestAnimationFrame(tick);
            }
        }
        function strokeLines(lines, w, a, col) {
            ctx.lineWidth = w;
            ctx.strokeStyle = 'rgba(' + col + ',' + a + ')';
            ctx.beginPath();
            lines.forEach(function (pts) {
                ctx.moveTo(pts[0][0], pts[0][1]);

                for (var i = 1; i < pts.length; i++) {
                    ctx.lineTo(pts[i][0], pts[i][1]);
                }
            });
            ctx.stroke();
        }

        function spawn(x, y) {
            if (P.length > MAX) {
                P.shift();
            }

            P.push({
                x: x + (Math.random() - 0.5) * 8,
                y: y + (Math.random() - 0.5) * 8,
                vx: (Math.random() - 0.5) * 0.6,
                vy: -0.15 - Math.random() * 0.45,
                r: 22 + Math.random() * 26,
                t: 0,
                max: 55 + Math.random() * 40,
                s: sprites[(Math.random() * 4) | 0],
            });
        }
        window.addEventListener(
            'pointermove',
            function (e) {
                if (e.pointerType !== 'mouse') {
                    return;
                }

                if (lx === null) {
                    lx = e.clientX;
                    ly = e.clientY;
                }

                var dx = e.clientX - lx,
                    dy = e.clientY - ly,
                    d = Math.sqrt(dx * dx + dy * dy);
                var n = Math.min(4, Math.ceil(d / 14));

                for (var i = 1; i <= n; i++) {
                    spawn(lx + (dx * i) / n, ly + (dy * i) / n);
                }

                travel += d;
                glow = 1;

                /* crackle while moving: faster mouse = more / longer bolts */
                if (
                    !charging &&
                    travel > 18 &&
                    performance.now() - lastB > 35 &&
                    B.length < 48 &&
                    Math.random() < 0.95
                ) {
                    var nb = d > 45 ? 4 : d > 20 ? 3 : 2;

                    for (var k = 0; k < nb; k++) {
                        bolt(
                            e.clientX,
                            e.clientY,
                            Math.random() * Math.PI * 2,
                            45 + Math.random() * 80 + Math.min(d, 70),
                            CH,
                            9 + ((Math.random() * 6) | 0),
                            0.45,
                        );
                    }

                    travel = 0;
                }

                lx = e.clientX;
                ly = e.clientY;

                if (!running) {
                    running = true;
                    requestAnimationFrame(tick);
                }
            },
            { passive: true, signal: controller.signal },
        );
        /* CHIDORI: hold the mouse button to charge, release to unleash */
        window.addEventListener(
            'pointerdown',
            function (e) {
                if (e.pointerType !== 'mouse' || e.button !== 0) {
                    return;
                }

                lx = e.clientX;
                ly = e.clientY;
                charging = true;
                chg = 0;

                if (!running) {
                    running = true;
                    requestAnimationFrame(tick);
                }
            },
            { signal: controller.signal },
        );
        function release() {
            if (!charging) {
                return;
            }

            charging = false;
            var n = 9 + Math.min(8, (chg / 12) | 0),
                L = 130 + Math.min(chg, 100) * 1.4;

            for (var i = 0; i < n; i++) {
                bolt(
                    lx,
                    ly,
                    (i / n) * Math.PI * 2 + Math.random() * 0.5,
                    L * (0.6 + Math.random() * 0.6),
                    CH,
                    20,
                    0.4,
                );
            }

            flash = { x: lx, y: ly, v: 1 };
        }
        window.addEventListener('pointerup', release, {
            signal: controller.signal,
        });
        window.addEventListener('pointercancel', release, {
            signal: controller.signal,
        });
        document.addEventListener(
            'mouseleave',
            function () {
                lx = null;
            },
            { signal: controller.signal },
        );

        function tick() {
            ctx.clearRect(0, 0, W, H);
            ctx.globalCompositeOperation = 'lighter';

            for (var i = P.length - 1; i >= 0; i--) {
                var p = P[i];
                p.t++;

                if (p.t > p.max) {
                    P.splice(i, 1);
                    continue;
                }

                var k = p.t / p.max;
                p.x += p.vx;
                p.y += p.vy;
                p.vx *= 0.985;
                p.vy -= 0.004;
                var sz = p.r * (1 + k * 2.4);
                ctx.globalAlpha = Math.pow(1 - k, 1.6) * 0.2;
                ctx.drawImage(p.s, p.x - sz / 2, p.y - sz / 2, sz, sz);
            }

            ctx.globalAlpha = 1;
            ctx.lineJoin = 'round';
            ctx.lineCap = 'round';

            if (charging && lx !== null) {
                chg++;
                var cnt = 2 + Math.min(4, (chg / 18) | 0);

                for (var c = 0; c < cnt; c++) {
                    bolt(
                        lx,
                        ly,
                        Math.random() * Math.PI * 2,
                        30 + Math.random() * (45 + Math.min(chg, 90)),
                        CH,
                        6 + ((Math.random() * 4) | 0),
                        0.45,
                    );
                }

                var R = 20 + Math.min(chg, 90) * 0.55 + Math.sin(chg * 0.9) * 4,
                    gr = ctx.createRadialGradient(lx, ly, 0, lx, ly, R);
                gr.addColorStop(0, 'rgba(255,255,255,.95)');
                gr.addColorStop(0.3, 'rgba(150,200,255,.55)');
                gr.addColorStop(1, 'rgba(70,130,255,0)');
                ctx.fillStyle = gr;
                ctx.fillRect(lx - R, ly - R, R * 2, R * 2);
            }

            if (glow > 0 && !charging && lx !== null) {
                var GR = 16 + glow * 8,
                    gg = ctx.createRadialGradient(lx, ly, 0, lx, ly, GR);
                gg.addColorStop(0, 'rgba(255,255,255,' + glow * 0.85 + ')');
                gg.addColorStop(0.35, 'rgba(150,200,255,' + glow * 0.45 + ')');
                gg.addColorStop(1, 'rgba(70,130,255,0)');
                ctx.fillStyle = gg;
                ctx.fillRect(lx - GR, ly - GR, GR * 2, GR * 2);
                glow -= 0.05;
            }

            if (flash) {
                var FR = 170,
                    fg = ctx.createRadialGradient(
                        flash.x,
                        flash.y,
                        0,
                        flash.x,
                        flash.y,
                        FR,
                    );
                fg.addColorStop(0, 'rgba(255,255,255,' + flash.v * 0.8 + ')');
                fg.addColorStop(
                    0.4,
                    'rgba(130,185,255,' + flash.v * 0.35 + ')',
                );
                fg.addColorStop(1, 'rgba(70,130,255,0)');
                ctx.fillStyle = fg;
                ctx.fillRect(flash.x - FR, flash.y - FR, FR * 2, FR * 2);
                flash.v -= 0.07;

                if (flash.v <= 0) {
                    flash = null;
                }
            }

            for (var j = B.length - 1; j >= 0; j--) {
                var b = B[j];
                b.t++;

                if (b.t > b.max) {
                    B.splice(j, 1);
                    continue;
                }

                var f =
                    (1 - b.t / b.max) *
                    (Math.random() > 0.28 ? 1 : 0.35); /* flicker */
                strokeLines(b.l, 7, 0.1 * f, b.c[0]);
                strokeLines(b.l, 3, 0.35 * f, b.c[1]);
                strokeLines(b.l, 1.2, 0.95 * f, b.c[2]);
            }

            if (
                (P.length || B.length || charging || flash || glow > 0) &&
                !document.hidden &&
                !disposed
            ) {
                requestAnimationFrame(tick);
            } else {
                running = false;
                ctx.clearRect(0, 0, W, H);
            }
        }
    }

    /* ---------- Profile: 3D tilt, glare, depth parallax ---------- */
    function profile() {
        var home = document.getElementById('home');
        var stage =
            home &&
            home.querySelector(
                '[aria-label="Decorative profile illustration"]',
            );
        var card = stage && stage.querySelector(':scope > div.relative');

        if (!card) {
            return;
        }

        var wrap = document.createElement('div');
        wrap.className = 'fx-tilt';
        card.parentNode.insertBefore(wrap, card);
        wrap.appendChild(card);
        var glare = document.createElement('span');
        glare.className = 'fx-glare';
        glare.setAttribute('aria-hidden', 'true');
        card.appendChild(glare);
        cleanups.push(function () {
            if (raf !== null) {
                cancelAnimationFrame(raf);
            }

            glare.remove();
            layers.forEach(function (element) {
                element.style.removeProperty('translate');
            });

            if (wrap.parentNode) {
                wrap.parentNode.insertBefore(card, wrap);
                wrap.remove();
            }
        });

        var layers = Array.prototype.filter.call(stage.children, function (c) {
            return c !== wrap;
        });
        var depth = [8, 14, -8, 22, 32, 12];
        var tx = 0,
            ty = 0,
            cx = 0,
            cy = 0,
            raf = null;

        home.addEventListener(
            'pointermove',
            function (e) {
                if (e.pointerType !== 'mouse') {
                    return;
                }

                var r = stage.getBoundingClientRect();
                tx = Math.max(
                    -0.5,
                    Math.min(0.5, (e.clientX - r.left) / r.width - 0.5),
                );
                ty = Math.max(
                    -0.5,
                    Math.min(0.5, (e.clientY - r.top) / r.height - 0.5),
                );
                var cr = card.getBoundingClientRect();
                glare.style.setProperty(
                    '--gx',
                    ((e.clientX - cr.left) / cr.width) * 100 + '%',
                );
                glare.style.setProperty(
                    '--gy',
                    ((e.clientY - cr.top) / cr.height) * 100 + '%',
                );

                if (!raf) {
                    raf = requestAnimationFrame(loop);
                }
            },
            { passive: true, signal: controller.signal },
        );
        home.addEventListener(
            'pointerleave',
            function () {
                tx = ty = 0;

                if (!raf) {
                    raf = requestAnimationFrame(loop);
                }
            },
            { signal: controller.signal },
        );

        function loop() {
            cx += (tx - cx) * 0.08;
            cy += (ty - cy) * 0.08;
            wrap.style.transform =
                'perspective(900px) rotateX(' +
                (-cy * 14).toFixed(2) +
                'deg) rotateY(' +
                (cx * 18).toFixed(2) +
                'deg)';
            layers.forEach(function (el, i) {
                var d = depth[i] || 10;
                el.style.translate =
                    (cx * d).toFixed(1) + 'px ' + (cy * d).toFixed(1) + 'px';
            });
            glare.style.opacity = Math.min(
                1,
                Math.abs(cx) + Math.abs(cy) + 0.15,
            );

            if (Math.abs(tx - cx) > 0.001 || Math.abs(ty - cy) > 0.001) {
                raf = requestAnimationFrame(loop);
            } else {
                raf = null;
            }
        }
    }

    /* ---------- Magnetic buttons ---------- */
    function magnet() {
        var originalTranslations = [];
        document
            .querySelectorAll(
                '.portfolio-page a[class*="bg-emerald-rich"],.portfolio-page button[type=submit],.portfolio-page header a[href="#contact"]',
            )
            .forEach(function (b) {
                originalTranslations.push([b, b.style.translate]);
                b.addEventListener(
                    'pointermove',
                    function (e) {
                        var r = b.getBoundingClientRect();
                        b.style.translate =
                            ((e.clientX - r.left - r.width / 2) * 0.18).toFixed(
                                1,
                            ) +
                            'px ' +
                            ((e.clientY - r.top - r.height / 2) * 0.3).toFixed(
                                1,
                            ) +
                            'px';
                    },
                    { signal: controller.signal },
                );
                b.addEventListener(
                    'pointerleave',
                    function () {
                        b.style.translate = '0 0';
                    },
                    { signal: controller.signal },
                );
            });
        cleanups.push(function () {
            originalTranslations.forEach(function (entry) {
                entry[0].style.translate = entry[1];
            });
        });
    }

    /* ---------- Cursor spotlight inside project cards ---------- */
    function spotlight() {
        var originalPositions = [];
        document
            .querySelectorAll('.portfolio-page #projects article')
            .forEach(function (a) {
                originalPositions.push([
                    a,
                    a.style.getPropertyValue('--mx'),
                    a.style.getPropertyValue('--my'),
                ]);
                a.addEventListener(
                    'pointermove',
                    function (e) {
                        var r = a.getBoundingClientRect();
                        a.style.setProperty('--mx', e.clientX - r.left + 'px');
                        a.style.setProperty('--my', e.clientY - r.top + 'px');
                    },
                    { signal: controller.signal },
                );
            });
        cleanups.push(function () {
            originalPositions.forEach(function (entry) {
                if (entry[1]) {
                    entry[0].style.setProperty('--mx', entry[1]);
                } else {
                    entry[0].style.removeProperty('--mx');
                }

                if (entry[2]) {
                    entry[0].style.setProperty('--my', entry[2]);
                } else {
                    entry[0].style.removeProperty('--my');
                }
            });
        });
    }

    return function () {
        disposed = true;
        controller.abort();
        timeouts.forEach(function (timeout) {
            clearTimeout(timeout);
        });
        cleanups.forEach(function (cleanup) {
            cleanup();
        });
    };
}
