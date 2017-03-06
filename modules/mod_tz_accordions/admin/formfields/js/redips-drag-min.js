/*
 Copyright (c) 2008-2011, www.redips.net All rights reserved.
 Code licensed under the BSD License: http://www.redips.net/license/
 http://www.redips.net/javascript/drag-and-drop-table-content/
 Version 5.0.8
 Jun 28, 2013.
 */
var REDIPS = REDIPS || {};
REDIPS.drag = function () {
    var q, B, J, za, La, Ma, ba, ca, ha, Aa, Ba, U, ia, Ca, Q, ja, X, Da, C, u, K, ka, la, ma, Ea, na, Fa, E, x, Ga, da, ea, oa, Na, Oa, Ha, pa, qa, ra, fa, Ia, Pa, sa, Qa, o = null, F = 0, G = 0, ta = null, ua = null, L = [], s = null, M = 0, N = 0, O = 0, P = 0, R = 0, S = 0, Y, f = [], Z, va, p, H = [], n = [], y = null, D = null, V = 0, W = 0, Ra = 0, Sa = 0, ga = !1, Ja = !1, $ = !1, wa = [], xa, j = null, t = null, z = null, h = null, v = null, I = null, k = null, A = null, T = null, i = !1, m = !1, r = "cell", ya = {div: [], cname: "only", other: "deny"}, Ta = {action: "deny", cname: "mark", exception: []}, l = {}, Ua = {keyDiv: !1, keyRow: !1, sendBack: !1,
        drop: !1};
    J = function () {
        return!1
    };
    q = function (a) {
        var b, c, d, e, g;
        f.length = 0;
        e = void 0 === a ? y.getElementsByTagName("table") : document.querySelectorAll(a);
        for (b = a = 0; a < e.length; a++)if (!("redips_clone" === e[a].parentNode.id || -1 < e[a].className.indexOf("nolayout"))) {
            c = e[a].parentNode;
            d = 0;
            do"TD" === c.nodeName && d++, c = c.parentNode; while (c && c !== y);
            f[b] = e[a];
            f[b].redips || (f[b].redips = {});
            f[b].redips.container = y;
            f[b].redips.nestedLevel = d;
            f[b].redips.idx = b;
            wa[b] = 0;
            d = f[b].getElementsByTagName("td");
            c = 0;
            for (g = !1; c < d.length; c++)if (1 <
                d[c].rowSpan) {
                g = !0;
                break
            }
            f[b].redips.rowspan = g;
            b++
        }
        a = 0;
        for (e = Z = 1; a < f.length; a++)if (0 === f[a].redips.nestedLevel) {
            f[a].redips.nestedGroup = e;
            f[a].redips.sort = 100 * Z;
            c = f[a].getElementsByTagName("table");
            for (b = 0; b < c.length; b++)-1 < c[b].className.indexOf("nolayout") || (c[b].redips.nestedGroup = e, c[b].redips.sort = 100 * Z + c[b].redips.nestedLevel);
            e++;
            Z++
        }
    };
    za = function (a) {
        var b = a || window.event, c, d;
        if (!0 === this.redips.animated)return!0;
        b.cancelBubble = !0;
        b.stopPropagation && b.stopPropagation();
        Ja = b.shiftKey;
        a = b.which ?
            b.which : b.button;
        if (Fa(b) || !b.touches && 1 !== a)return!0;
        if (window.getSelection)window.getSelection().removeAllRanges(); else if (document.selection && "Text" === document.selection.type)try {
            document.selection.empty()
        } catch (e) {
        }
        b.touches ? (a = V = b.touches[0].clientX, d = W = b.touches[0].clientY) : (a = V = b.clientX, d = W = b.clientY);
        Ra = a;
        Sa = d;
        ga = !1;
        REDIPS.drag.objOld = m = i || this;
        REDIPS.drag.obj = i = this;
        $ = -1 < i.className.indexOf("clone") ? !0 : !1;
        REDIPS.drag.tableSort && Ma(i);
        y !== i.redips.container && (y = i.redips.container, q());
        -1 ===
            i.className.indexOf("row") ? REDIPS.drag.mode = r = "cell" : (REDIPS.drag.mode = r = "row", REDIPS.drag.obj = i = fa(i));
        u();
        !$ && "cell" === r && (i.style.zIndex = 999);
        j = h = k = null;
        Q();
        z = t = j;
        I = v = h;
        T = A = k;
        REDIPS.drag.td.source = l.source = x("TD", i);
        REDIPS.drag.td.current = l.current = l.source;
        REDIPS.drag.td.previous = l.previous = l.source;
        "cell" === r ? REDIPS.drag.event.clicked(l.current) : REDIPS.drag.event.rowClicked(l.current);
        if (null === j || null === h || null === k)if (Q(), z = t = j, I = v = h, T = A = k, null === j || null === h || null === k)return!0;
        va = p = !1;
        REDIPS.event.add(document,
            "mousemove", ca);
        REDIPS.event.add(document, "touchmove", ca);
        REDIPS.event.add(document, "mouseup", ba);
        REDIPS.event.add(document, "touchend", ba);
        i.setCapture && i.setCapture();
        null !== j && (null !== h && null !== k) && (Y = Da(j, h, k));
        c = E(f[z], "position");
        "fixed" !== c && (c = E(f[z].parentNode, "position"));
        c = C(i, c);
        o = [d - c[0], c[1] - a, c[2] - d, a - c[3]];
        y.onselectstart = function (a) {
            b = a || window.event;
            if (!Fa(b)) {
                b.shiftKey && document.selection.clear();
                return false
            }
        };
        return!1
    };
    La = function () {
        REDIPS.drag.event.dblClicked()
    };
    Ma = function (a) {
        var b;
        b = x("TABLE", a).redips.nestedGroup;
        for (a = 0; a < f.length; a++)f[a].redips.nestedGroup === b && (f[a].redips.sort = 100 * Z + f[a].redips.nestedLevel);
        f.sort(function (a, b) {
            return b.redips.sort - a.redips.sort
        });
        Z++
    };
    fa = function (a, b) {
        var c, d, e, g, f, w;
        if ("DIV" === a.nodeName)return g = a, a = x("TR", a), void 0 === a.redips && (a.redips = {}), a.redips.div = g, a;
        d = a;
        void 0 === d.redips && (d.redips = {});
        a = x("TABLE", a);
        $ && p && (g = d.redips.div, g.className = sa(g.className.replace("clone", "")));
        c = a.cloneNode(!0);
        $ && p && (g.className += " clone");
        e = c.rows.length -
            1;
        g = "animated" === b ? 0 === e ? !0 : !1 : !0;
        for (f = e; 0 <= f; f--)if (f !== d.rowIndex) {
            if (!0 === g && void 0 === b) {
                e = c.rows[f];
                for (w = 0; w < e.cells.length; w++)if (-1 < e.cells[w].className.indexOf("rowhandler")) {
                    g = !1;
                    break
                }
            }
            c.deleteRow(f)
        }
        p || (d.redips.emptyRow = g);
        c.redips = {};
        c.redips.container = a.redips.container;
        c.redips.sourceRow = d;
        Pa(d, c.rows[0]);
        Ea(d, c.rows[0]);
        document.getElementById("redips_clone").appendChild(c);
        d = C(d, "fixed");
        c.style.position = "fixed";
        c.style.top = d[0] + "px";
        c.style.left = d[3] + "px";
        c.style.width = d[1] - d[3] +
            "px";
        return c
    };
    Ia = function (a, b, c) {
        var d = !1, e, g, Ka, w, h, k, aa, n;
        n = function (a) {
            var b;
            void 0 === a.redips || !a.redips.emptyRow ? (b = x("TABLE", a), b.deleteRow(a.rowIndex)) : ra(a, "empty", REDIPS.drag.style.rowEmptyColor)
        };
        void 0 === c ? c = i : d = !0;
        e = c.redips.sourceRow;
        g = e.rowIndex;
        Ka = x("TABLE", e);
        w = e.parentNode;
        a = f[a];
        b > a.rows.length - 1 && (b = a.rows.length - 1);
        h = a.rows[b];
        k = b;
        aa = h.parentNode;
        b = c.getElementsByTagName("tr")[0];
        c.parentNode.removeChild(c);
        !1 !== REDIPS.drag.event.rowDroppedBefore(Ka, g) && (!d && -1 < l.target.className.indexOf(REDIPS.drag.trash.className) ?
            p ? REDIPS.drag.event.rowDeleted() : REDIPS.drag.trash.questionRow ? confirm(REDIPS.drag.trash.questionRow) ? (n(e), REDIPS.drag.event.rowDeleted()) : (delete m.redips.emptyRow, REDIPS.drag.event.rowUndeleted()) : (n(e), REDIPS.drag.event.rowDeleted()) : (k < a.rows.length ? j === z ? g > k ? aa.insertBefore(b, h) : aa.insertBefore(b, h.nextSibling) : "after" === REDIPS.drag.rowDropMode ? aa.insertBefore(b, h.nextSibling) : aa.insertBefore(b, h) : (aa.appendChild(b), h = a.rows[0]), h && h.redips && h.redips.emptyRow ? a.deleteRow(h.rowIndex) : "overwrite" ===
            REDIPS.drag.rowDropMode ? n(h) : "switch" === REDIPS.drag.rowDropMode && !p && (w.insertBefore(h, e), void 0 !== e.redips && delete e.redips.emptyRow), (d || !p) && n(e), delete b.redips.emptyRow, d || REDIPS.drag.event.rowDropped(b, Ka, g)), 0 < b.getElementsByTagName("table").length && q())
    };
    Pa = function (a, b) {
        var c, d, e, g = [], f = [];
        g[0] = a.getElementsByTagName("input");
        g[1] = a.getElementsByTagName("textarea");
        g[2] = a.getElementsByTagName("select");
        f[0] = b.getElementsByTagName("input");
        f[1] = b.getElementsByTagName("textarea");
        f[2] = b.getElementsByTagName("select");
        for (c = 0; c < g.length; c++)for (d = 0; d < g[c].length; d++)switch (e = g[c][d].type, e) {
            case "text":
            case "textarea":
            case "password":
                f[c][d].value = g[c][d].value;
                break;
            case "radio":
            case "checkbox":
                f[c][d].checked = g[c][d].checked;
                break;
            case "select-one":
                f[c][d].selectedIndex = g[c][d].selectedIndex;
                break;
            case "select-multiple":
                for (e = 0; e < g[c][d].options.length; e++)f[c][d].options[e].selected = g[c][d].options[e].selected
        }
    };
    ba = function (a) {
        var b = a || window.event, c, d, e, a = b.clientX;
        e = b.clientY;
        R = S = 0;
        i.releaseCapture && i.releaseCapture();
        REDIPS.event.remove(document, "mousemove", ca);
        REDIPS.event.remove(document, "touchmove", ca);
        REDIPS.event.remove(document, "mouseup", ba);
        REDIPS.event.remove(document, "touchend", ba);
        y.onselectstart = null;
        Ba(i);
        ta = document.documentElement.scrollWidth;
        ua = document.documentElement.scrollHeight;
        R = S = 0;
        if (p && "cell" === r && (null === j || null === h || null === k))i.parentNode.removeChild(i), H[m.id] -= 1, REDIPS.drag.event.notCloned(); else if (null === j || null === h || null === k)REDIPS.drag.event.notMoved(); else {
            j < f.length ? (b = f[j], REDIPS.drag.td.target =
                l.target = b.rows[h].cells[k], X(j, h, k, Y), c = j, d = h) : null === t || null === v || null === A ? (b = f[z], REDIPS.drag.td.target = l.target = b.rows[I].cells[T], X(z, I, T, Y), c = z, d = I) : (b = f[t], REDIPS.drag.td.target = l.target = b.rows[v].cells[A], X(t, v, A, Y), c = t, d = v);
            if ("row" === r)if (va)if (z === c && I === d) {
                b = i.getElementsByTagName("tr")[0];
                m.style.backgroundColor = b.style.backgroundColor;
                for (a = 0; a < b.cells.length; a++)m.cells[a].style.backgroundColor = b.cells[a].style.backgroundColor;
                i.parentNode.removeChild(i);
                delete m.redips.emptyRow;
                p ?
                    REDIPS.drag.event.rowNotCloned() : REDIPS.drag.event.rowDroppedSource(l.target)
            } else Ia(c, d); else REDIPS.drag.event.rowNotMoved(); else if (!p && !ga)REDIPS.drag.event.notMoved(); else if (p && z === j && I === h && T === k)i.parentNode.removeChild(i), H[m.id] -= 1, REDIPS.drag.event.notCloned(); else if (p && !1 === REDIPS.drag.clone.drop && (a < b.redips.offset[3] || a > b.redips.offset[1] || e < b.redips.offset[0] || e > b.redips.offset[2]))i.parentNode.removeChild(i), H[m.id] -= 1, REDIPS.drag.event.notCloned(); else if (-1 < l.target.className.indexOf(REDIPS.drag.trash.className))i.parentNode.removeChild(i),
                REDIPS.drag.trash.question ? setTimeout(function () {
                    if (confirm(REDIPS.drag.trash.question))Aa(); else {
                        if (!p) {
                            f[z].rows[I].cells[T].appendChild(i);
                            u()
                        }
                        REDIPS.drag.event.undeleted()
                    }
                }, 20) : Aa(); else if ("switch" === REDIPS.drag.dropMode)if (a = REDIPS.drag.event.droppedBefore(l.target), !1 === a)ha(!1); else {
                i.parentNode.removeChild(i);
                b = l.target.getElementsByTagName("div");
                c = b.length;
                for (a = 0; a < c; a++)void 0 !== b[0] && (REDIPS.drag.objOld = m = b[0], l.source.appendChild(m), U(m));
                ha();
                c && REDIPS.drag.event.switched()
            } else"overwrite" ===
                REDIPS.drag.dropMode ? (a = REDIPS.drag.event.droppedBefore(l.target), !1 !== a && ea(l.target)) : a = REDIPS.drag.event.droppedBefore(l.target), ha(a);
            "cell" === r && 0 < i.getElementsByTagName("table").length && q();
            u();
            REDIPS.drag.event.finish()
        }
        t = v = A = null
    };
    ha = function (a) {
        var b = null, c;
        if (!1 !== a) {
            if (!0 === Ua.sendBack) {
                a = l.target.getElementsByTagName("DIV");
                for (c = 0; c < a.length; c++)if (i !== a[c] && 0 === i.id.indexOf(a[c].id)) {
                    b = a[c];
                    break
                }
                if (b) {
                    na(b, 1);
                    i.parentNode.removeChild(i);
                    return
                }
            }
            "shift" === REDIPS.drag.dropMode && (Qa(l.target) ||
                "always" === REDIPS.drag.shift.after) && oa(l.source, l.target);
            "top" === REDIPS.drag.multipleDrop && l.target.hasChildNodes() ? l.target.insertBefore(i, l.target.firstChild) : l.target.appendChild(i);
            U(i);
            REDIPS.drag.event.dropped(l.target);
            p && (REDIPS.drag.event.clonedDropped(l.target), na(m, -1))
        } else p && i.parentNode && i.parentNode.removeChild(i)
    };
    U = function (a, b) {
        !1 === b ? (a.onmousedown = null, a.ontouchstart = null, a.ondblclick = null) : (a.onmousedown = za, a.ontouchstart = za, a.ondblclick = La)
    };
    Ba = function (a) {
        a.style.top = "";
        a.style.left = "";
        a.style.position = "";
        a.style.zIndex = ""
    };
    Aa = function () {
        var a;
        p && na(m, -1);
        if ("shift" === REDIPS.drag.dropMode && ("delete" === REDIPS.drag.shift.after || "always" === REDIPS.drag.shift.after)) {
            switch (REDIPS.drag.shift.mode) {
                case "vertical2":
                    a = "lastInColumn";
                    break;
                case "horizontal2":
                    a = "lastInRow";
                    break;
                default:
                    a = "last"
            }
            oa(l.source, Ga(a, l.source)[2])
        }
        REDIPS.drag.event.deleted(p)
    };
    ca = function (a) {
        var a = a || window.event, b = REDIPS.drag.scroll.bound, c, d, e, g;
        a.touches ? (d = V = a.touches[0].clientX, e = W = a.touches[0].clientY) :
            (d = V = a.clientX, e = W = a.clientY);
        c = Math.abs(Ra - d);
        g = Math.abs(Sa - e);
        if (!va) {
            if ("cell" === r && ($ || !0 === REDIPS.drag.clone.keyDiv && Ja))REDIPS.drag.objOld = m = i, REDIPS.drag.obj = i = ma(i, !0), p = !0, REDIPS.drag.event.cloned(); else {
                if ("row" === r) {
                    if ($ || !0 === REDIPS.drag.clone.keyRow && Ja)p = !0;
                    REDIPS.drag.objOld = m = i;
                    REDIPS.drag.obj = i = fa(i);
                    i.style.zIndex = 999
                }
                i.setCapture && i.setCapture();
                i.style.position = "fixed";
                u();
                Q();
                "row" === r && (p ? REDIPS.drag.event.rowCloned() : REDIPS.drag.event.rowMoved())
            }
            ja();
            d > F - o[1] && (i.style.left =
                F - (o[1] + o[3]) + "px");
            e > G - o[2] && (i.style.top = G - (o[0] + o[2]) + "px")
        }
        va = !0;
        if ("cell" === r && (7 < c || 7 < g) && !ga)ga = !0, ja(), REDIPS.drag.event.moved(p);
        d > o[3] && d < F - o[1] && (i.style.left = d - o[3] + "px");
        e > o[0] && e < G - o[2] && (i.style.top = e - o[0] + "px");
        if (d < D[1] && d > D[3] && e < D[2] && e > D[0] && 0 === R && 0 === S && (n.containTable || d < n[3] || d > n[1] || e < n[0] || e > n[2]))Q(), ia();
        if (REDIPS.drag.scroll.enable) {
            M = b - (F / 2 > d ? d - o[3] : F - d - o[1]);
            if (0 < M) {
                if (M > b && (M = b), c = K()[0], M *= d < F / 2 ? -1 : 1, !(0 > M && 0 >= c || 0 < M && c >= ta - F) && 0 === R++)REDIPS.event.remove(window, "scroll",
                    u), ka(window)
            } else M = 0;
            N = b - (G / 2 > e ? e - o[0] : G - e - o[2]);
            if (0 < N) {
                if (N > b && (N = b), c = K()[1], N *= e < G / 2 ? -1 : 1, !(0 > N && 0 >= c || 0 < N && c >= ua - G) && 0 === S++)REDIPS.event.remove(window, "scroll", u), la(window)
            } else N = 0;
            for (g = 0; g < L.length; g++)if (c = L[g], c.autoscroll && d < c.offset[1] && d > c.offset[3] && e < c.offset[2] && e > c.offset[0]) {
                O = b - (c.midstX > d ? d - o[3] - c.offset[3] : c.offset[1] - d - o[1]);
                0 < O ? (O > b && (O = b), O *= d < c.midstX ? -1 : 1, 0 === R++ && (REDIPS.event.remove(c.div, "scroll", u), ka(c.div))) : O = 0;
                P = b - (c.midstY > e ? e - o[0] - c.offset[0] : c.offset[2] - e -
                    o[2]);
                0 < P ? (P > b && (P = b), P *= e < c.midstY ? -1 : 1, 0 === S++ && (REDIPS.event.remove(c.div, "scroll", u), la(c.div))) : P = 0;
                break
            } else O = P = 0
        }
        a.cancelBubble = !0;
        a.stopPropagation && a.stopPropagation()
    };
    ia = function () {
        if (j < f.length && (j !== t || h !== v || k !== A))null !== t && (null !== v && null !== A) && (X(t, v, A, Y), REDIPS.drag.td.previous = l.previous = f[t].rows[v].cells[A], REDIPS.drag.td.current = l.current = f[j].rows[h].cells[k], "switching" === REDIPS.drag.dropMode && "cell" === r && (da(l.current, l.previous), u(), Q()), "cell" === r ? REDIPS.drag.event.changed(l.current) :
            "row" === r && (j !== t || h !== v) && REDIPS.drag.event.rowChanged(l.current)), ja()
    };
    Ca = function () {
        if ("number" === typeof window.innerWidth)F = window.innerWidth, G = window.innerHeight; else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight))F = document.documentElement.clientWidth, G = document.documentElement.clientHeight; else if (document.body && (document.body.clientWidth || document.body.clientHeight))F = document.body.clientWidth, G = document.body.clientHeight;
        ta = document.documentElement.scrollWidth;
        ua = document.documentElement.scrollHeight;
        u()
    };
    Q = function () {
        var a, b, c, d, e, g;
        c = [];
        a = function () {
            null !== t && (null !== v && null !== A) && (j = t, h = v, k = A)
        };
        b = V;
        g = W;
        for (j = 0; j < f.length; j++)if (!1 !== f[j].redips.enabled && (c[0] = f[j].redips.offset[0], c[1] = f[j].redips.offset[1], c[2] = f[j].redips.offset[2], c[3] = f[j].redips.offset[3], void 0 !== f[j].sca && (c[0] = c[0] > f[j].sca.offset[0] ? c[0] : f[j].sca.offset[0], c[1] = c[1] < f[j].sca.offset[1] ? c[1] : f[j].sca.offset[1], c[2] = c[2] < f[j].sca.offset[2] ? c[2] : f[j].sca.offset[2], c[3] = c[3] > f[j].sca.offset[3] ?
            c[3] : f[j].sca.offset[3]), c[3] < b && b < c[1] && c[0] < g && g < c[2])) {
            c = f[j].redips.row_offset;
            for (h = 0; h < c.length - 1; h++)if (void 0 !== c[h]) {
                n[0] = c[h][0];
                if (void 0 !== c[h + 1])n[2] = c[h + 1][0]; else for (d = h + 2; d < c.length; d++)if (void 0 !== c[d]) {
                    n[2] = c[d][0];
                    break
                }
                if (g <= n[2])break
            }
            d = h;
            h === c.length - 1 && (n[0] = c[h][0], n[2] = f[j].redips.offset[2]);
            do for (k = e = f[j].rows[h].cells.length - 1; 0 <= k && !(n[3] = c[h][3] + f[j].rows[h].cells[k].offsetLeft, n[1] = n[3] + f[j].rows[h].cells[k].offsetWidth, n[3] <= b && b <= n[1]); k--); while (f[j].redips.rowspan &&
                -1 === k && 0 < h--);
            0 > h || 0 > k ? a() : h !== d && (n[0] = c[h][0], n[2] = n[0] + f[j].rows[h].cells[k].offsetHeight, (g < n[0] || g > n[2]) && a());
            b = f[j].rows[h].cells[k];
            n.containTable = 0 < b.childNodes.length && 0 < b.getElementsByTagName("table").length ? !0 : !1;
            if (-1 === b.className.indexOf(REDIPS.drag.trash.className))if (g = -1 < b.className.indexOf(REDIPS.drag.only.cname) ? !0 : !1, !0 === g) {
                if (-1 === b.className.indexOf(ya.div[i.id])) {
                    a();
                    break
                }
            } else if (void 0 !== ya.div[i.id] && "deny" === ya.other) {
                a();
                break
            } else if (g = -1 < b.className.indexOf(REDIPS.drag.mark.cname) ?
                !0 : !1, (!0 === g && "deny" === REDIPS.drag.mark.action || !1 === g && "allow" === REDIPS.drag.mark.action) && -1 === b.className.indexOf(Ta.exception[i.id])) {
                a();
                break
            }
            g = -1 < b.className.indexOf("single") ? !0 : !1;
            if ("cell" === r) {
                if (("single" === REDIPS.drag.dropMode || g) && 0 < b.childNodes.length) {
                    if (1 === b.childNodes.length && 3 === b.firstChild.nodeType)break;
                    g = !0;
                    for (d = b.childNodes.length - 1; 0 <= d; d--)if (b.childNodes[d].className && -1 < b.childNodes[d].className.indexOf("drag")) {
                        g = !1;
                        break
                    }
                    if (!g && (null !== t && null !== v && null !== A) && (z !==
                        j || I !== h || T !== k)) {
                        a();
                        break
                    }
                }
                if (-1 < b.className.indexOf("rowhandl" +
                    "er")) {
                    a();
                    break
                }
                if (b.parentNode.redips && b.parentNode.redips.emptyRow) {
                    a();
                    break
                }
            }
            break
        }
    };
    ja = function () {
        j < f.length && (null !== j && null !== h && null !== k) && (Y = Da(j, h, k), X(j, h, k), t = j, v = h, A = k)
    };
    X = function (a, b, c, d) {
        if ("cell" === r && ga)c = f[a].rows[b].cells[c].style, c.backgroundColor = void 0 === d ? REDIPS.drag.hover.colorTd : d.color[0].toString(), void 0 !== REDIPS.drag.hover.borderTd && (void 0 === d ? c.border = REDIPS.drag.hover.borderTd : (c.borderTopWidth = d.top[0][0],
            c.borderTopStyle = d.top[0][1], c.borderTopColor = d.top[0][2], c.borderRightWidth = d.right[0][0], c.borderRightStyle = d.right[0][1], c.borderRightColor = d.right[0][2], c.borderBottomWidth = d.bottom[0][0], c.borderBottomStyle = d.bottom[0][1], c.borderBottomColor = d.bottom[0][2], c.borderLeftWidth = d.left[0][0], c.borderLeftStyle = d.left[0][1], c.borderLeftColor = d.left[0][2])); else if ("row" === r) {
            a = f[a].rows[b];
            for (b = 0; b < a.cells.length; b++)c = a.cells[b].style, c.backgroundColor = void 0 === d ? REDIPS.drag.hover.colorTr : d.color[b].toString(),
                void 0 !== REDIPS.drag.hover.borderTr && (void 0 === d ? j === z ? h < I ? c.borderTop = REDIPS.drag.hover.borderTr : c.borderBottom = REDIPS.drag.hover.borderTr : "before" === REDIPS.drag.rowDropMode ? c.borderTop = REDIPS.drag.hover.borderTr : c.borderBottom = REDIPS.drag.hover.borderTr : (c.borderTopWidth = d.top[b][0], c.borderTopStyle = d.top[b][1], c.borderTopColor = d.top[b][2], c.borderBottomWidth = d.bottom[b][0], c.borderBottomStyle = d.bottom[b][1], c.borderBottomColor = d.bottom[b][2]))
        }
    };
    Da = function (a, b, c) {
        var d = {color: [], top: [], right: [],
            bottom: [], left: []}, e = function (a, b) {
            var c = "border" + b + "Style", d = "border" + b + "Color";
            return[E(a, "border" + b + "Width"), E(a, c), E(a, d)]
        };
        if ("cell" === r)c = f[a].rows[b].cells[c], d.color[0] = c.style.backgroundColor, void 0 !== REDIPS.drag.hover.borderTd && (d.top[0] = e(c, "Top"), d.right[0] = e(c, "Right"), d.bottom[0] = e(c, "Bottom"), d.left[0] = e(c, "Left")); else {
            a = f[a].rows[b];
            for (b = 0; b < a.cells.length; b++)c = a.cells[b], d.color[b] = c.style.backgroundColor, void 0 !== REDIPS.drag.hover.borderTr && (d.top[b] = e(c, "Top"), d.bottom[b] = e(c,
                "Bottom"))
        }
        return d
    };
    C = function (a, b, c) {
        var d = 0, e = 0, g = a;
        "fixed" !== b && (d = 0 - xa[0], e = 0 - xa[1]);
        if (void 0 === c || !0 === c) {
            do d += a.offsetLeft - a.scrollLeft, e += a.offsetTop - a.scrollTop, a = a.offsetParent; while (a && "BODY" !== a.nodeName)
        } else {
            do d += a.offsetLeft, e += a.offsetTop, a = a.offsetParent; while (a && "BODY" !== a.nodeName)
        }
        return[e, d + g.offsetWidth, e + g.offsetHeight, d]
    };
    u = function () {
        var a, b, c, d;
        xa = K();
        for (a = 0; a < f.length; a++) {
            c = [];
            d = E(f[a], "position");
            "fixed" !== d && (d = E(f[a].parentNode, "position"));
            for (b = f[a].rows.length -
                1; 0 <= b; b--)"none" !== f[a].rows[b].style.display && (c[b] = C(f[a].rows[b], d));
            f[a].redips.offset = C(f[a], d);
            f[a].redips.row_offset = c
        }
        D = C(y);
        for (a = 0; a < L.length; a++)d = E(L[a].div, "position"), b = C(L[a].div, d, !1), L[a].offset = b, L[a].midstX = (b[1] + b[3]) / 2, L[a].midstY = (b[0] + b[2]) / 2
    };
    K = function () {
        var a, b;
        "number" === typeof window.pageYOffset ? (a = window.pageXOffset, b = window.pageYOffset) : document.body && (document.body.scrollLeft || document.body.scrollTop) ? (a = document.body.scrollLeft, b = document.body.scrollTop) : document.documentElement &&
            (document.documentElement.scrollLeft || document.documentElement.scrollTop) ? (a = document.documentElement.scrollLeft, b = document.documentElement.scrollTop) : a = b = 0;
        return[a, b]
    };
    ka = function (a) {
        var b, c;
        b = V;
        c = W;
        0 < R && (u(), Q(), b < D[1] && (b > D[3] && c < D[2] && c > D[0]) && ia());
        "object" === typeof a && (s = a);
        s === window ? (a = K()[0], b = ta - F, c = M) : (a = s.scrollLeft, b = s.scrollWidth - s.clientWidth, c = O);
        0 < R && (0 > c && 0 < a || 0 < c && a < b) ? (s === window ? (window.scrollBy(c, 0), K(), a = parseInt(i.style.left, 10), isNaN(a)) : s.scrollLeft += c, setTimeout(ka, REDIPS.drag.scroll.speed)) :
            (REDIPS.event.add(s, "scroll", u), R = 0, n = [0, 0, 0, 0])
    };
    la = function (a) {
        var b, c;
        b = V;
        c = W;
        0 < S && (u(), Q(), b < D[1] && (b > D[3] && c < D[2] && c > D[0]) && ia());
        "object" === typeof a && (s = a);
        s === window ? (a = K()[1], b = ua - G, c = N) : (a = s.scrollTop, b = s.scrollHeight - s.clientHeight, c = P);
        0 < S && (0 > c && 0 < a || 0 < c && a < b) ? (s === window ? (window.scrollBy(0, c), K(), a = parseInt(i.style.top, 10), isNaN(a)) : s.scrollTop += c, setTimeout(la, REDIPS.drag.scroll.speed)) : (REDIPS.event.add(s, "scroll", u), S = 0, n = [0, 0, 0, 0])
    };
    ma = function (a, b) {
        var c = a.cloneNode(!0), d = c.className,
            e, g;
        !0 === b && (document.getElementById("redips_clone").appendChild(c), c.style.zIndex = 999, c.style.position = "fixed", e = C(a), g = C(c), c.style.top = e[0] - g[0] + "px", c.style.left = e[3] - g[3] + "px");
        c.setCapture && c.setCapture();
        d = d.replace("clone", "");
        d = d.replace(/climit(\d)_(\d+)/, "");
        c.className = sa(d);
        void 0 === H[a.id] && (H[a.id] = 0);
        c.id = a.id + "c" + H[a.id];
        H[a.id] += 1;
        Ea(a, c);
        return c
    };
    Ea = function (a, b) {
        var c = [], d;
        c[0] = function (a, b) {
            a.redips && (b.redips = {}, b.redips.enabled = a.redips.enabled, b.redips.container = a.redips.container,
                a.redips.enabled && U(b))
        };
        c[1] = function (a, b) {
            a.redips && (b.redips = {}, b.redips.emptyRow = a.redips.emptyRow)
        };
        d = function (d) {
            var g, f, w;
            f = ["DIV", "TR"];
            g = a.getElementsByTagName(f[d]);
            f = b.getElementsByTagName(f[d]);
            for (w = 0; w < f.length; w++)c[d](g[w], f[w])
        };
        if ("DIV" === a.nodeName)c[0](a, b); else if ("TR" === a.nodeName)c[1](a, b);
        d(0);
        d(1)
    };
    na = function (a, b) {
        var c, d, e;
        e = a.className;
        c = e.match(/climit(\d)_(\d+)/);
        null !== c && (d = parseInt(c[1], 10), c = parseInt(c[2], 10), 0 === c && 1 === b && (e += " clone", 2 === d && B(!0, a)), c += b, e = e.replace(/climit\d_\d+/g,
            "climit" + d + "_" + c), 0 >= c && (e = e.replace("clone", ""), 2 === d ? (B(!1, a), REDIPS.drag.event.clonedEnd2()) : REDIPS.drag.event.clonedEnd1()), a.className = sa(e))
    };
    Fa = function (a) {
        var b = !1;
        a.srcElement ? (b = a.srcElement.nodeName, a = a.srcElement.className) : (b = a.target.nodeName, a = a.target.className);
        switch (b) {
            case "A":
            case "INPUT":
            case "SELECT":
            case "OPTION":
            case "TEXTAREA":
                b = !0;
                break;
            default:
                b = /\bnodrag\b/i.test(a) ? !0 : !1
        }
        return b
    };
    B = function (a, b) {
        var c, d, e, g = [], f = [], w, i, h, j, l = /\bdrag\b/i, k = /\bnoautoscroll\b/i;
        i = REDIPS.drag.style.opacityDisabled;
        !0 === a || "init" === a ? (w = REDIPS.drag.style.borderEnabled, h = "move", j = !0) : (w = REDIPS.drag.style.borderDisabled, h = "auto", j = !1);
        void 0 === b ? g = y.getElementsByTagName("div") : "string" === typeof b ? g = document.querySelectorAll(b) : "object" === typeof b && ("DIV" !== b.nodeName || -1 === b.className.indexOf("drag")) ? g = b.getElementsByTagName("div") : g[0] = b;
        for (d = c = 0; c < g.length; c++)if (l.test(g[c].className))"init" === a || void 0 === g[c].redips ? (g[c].redips = {}, g[c].redips.container = y) : !0 === a && "number" === typeof i ? (g[c].style.opacity =
            "", g[c].style.filter = "") : !1 === a && "number" === typeof i && (g[c].style.opacity = i / 100, g[c].style.filter = "alpha(opacity=" + i + ")"), U(g[c], j), g[c].style.borderStyle = w, g[c].style.cursor = h, g[c].redips.enabled = j; else if ("init" === a && (e = E(g[c], "overflow"), "visible" !== e)) {
            REDIPS.event.add(g[c], "scroll", u);
            e = E(g[c], "position");
            f = C(g[c], e, !1);
            e = k.test(g[c].className) ? !1 : !0;
            L[d] = {div: g[c], offset: f, midstX: (f[1] + f[3]) / 2, midstY: (f[0] + f[2]) / 2, autoscroll: e};
            f = g[c].getElementsByTagName("table");
            for (e = 0; e < f.length; e++)f[e].sca =
                L[d];
            d++
        }
    };
    E = function (a, b) {
        var c;
        a && a.currentStyle ? c = a.currentStyle[b] : a && window.getComputedStyle && (c = document.defaultView.getComputedStyle(a, null)[b]);
        return c
    };
    x = function (a, b, c) {
        b = b.parentNode;
        for (void 0 === c && (c = 0); b && b.nodeName !== a;)if ((b = b.parentNode) && b.nodeName === a && 0 < c)c--, b = b.parentNode;
        return b
    };
    Ga = function (a, b) {
        var c = x("TABLE", b), d, e;
        switch (a) {
            case "firstInColumn":
                d = 0;
                e = b.cellIndex;
                break;
            case "firstInRow":
                d = b.parentNode.rowIndex;
                e = 0;
                break;
            case "lastInColumn":
                d = c.rows.length - 1;
                e = b.cellIndex;
                break;
            case "lastInRow":
                d = b.parentNode.rowIndex;
                e = c.rows[d].cells.length - 1;
                break;
            case "last":
                d = c.rows.length - 1;
                e = c.rows[d].cells.length - 1;
                break;
            default:
                d = e = 0
        }
        return[d, e, c.rows[d].cells[e]]
    };
    da = function (a, b, c) {
        var d, e, g;
        d = function (a, b) {
            REDIPS.drag.event.relocateBefore(a, b);
            var c = REDIPS.drag.getPosition(b);
            REDIPS.drag.moveObject({obj: a, target: c, callback: function (a) {
                var c = REDIPS.drag.findParent("TABLE", a), d = c.redips.idx;
                REDIPS.drag.event.relocateAfter(a, b);
                wa[d]--;
                0 === wa[d] && (REDIPS.drag.event.relocateEnd(),
                    REDIPS.drag.enableTable(!0, c))
            }})
        };
        if (a !== b && !("object" !== typeof a || "object" !== typeof b))if (g = a.childNodes.length, "animation" === c) {
            if (0 < g) {
                c = x("TABLE", b);
                e = c.redips.idx;
                REDIPS.drag.enableTable(!1, c);
                for (c = 0; c < g; c++)1 === a.childNodes[c].nodeType && "DIV" === a.childNodes[c].nodeName && (wa[e]++, d(a.childNodes[c], b))
            }
        } else for (d = c = 0; c < g; c++)1 === a.childNodes[d].nodeType && "DIV" === a.childNodes[d].nodeName ? (e = a.childNodes[d], REDIPS.drag.event.relocateBefore(e, b), b.appendChild(e), e.redips && !1 !== e.redips.enabled &&
            U(e), REDIPS.drag.event.relocateAfter(e)) : d++
    };
    ea = function (a, b) {
        var c, d = [], e;
        if ("TD" === a.nodeName) {
            c = a.childNodes.length;
            if ("test" === b)return c = l.source === a ? void 0 : 0 === a.childNodes.length || 1 === a.childNodes.length && 3 === a.firstChild.nodeType ? !0 : !1;
            for (e = 0; e < c; e++)d.push(a.childNodes[0]), a.removeChild(a.childNodes[0]);
            return d
        }
    };
    oa = function (a, b) {
        var c, d, e, g, f, i, h, j, k, n, m, o, p = !1, q, r;
        q = function (a, b) {
            REDIPS.drag.shift.animation ? da(a, b, "animation") : da(a, b)
        };
        r = function (a) {
            "delete" === REDIPS.drag.shift.overflow ?
                ea(a) : "source" === REDIPS.drag.shift.overflow ? q(a, l.source) : "object" === typeof REDIPS.drag.shift.overflow && q(a, REDIPS.drag.shift.overflow);
            p = !1;
            REDIPS.drag.event.shiftOverflow(a)
        };
        if (a !== b) {
            f = REDIPS.drag.shift.mode;
            c = x("TABLE", a);
            d = x("TABLE", b);
            i = Na(d);
            e = c === d ? [a.redips.rowIndex, a.redips.cellIndex] : [-1, -1];
            g = [b.redips.rowIndex, b.redips.cellIndex];
            m = d.rows.length;
            o = Oa(d);
            switch (f) {
                case "vertical2":
                    c = c === d && a.redips.cellIndex === b.redips.cellIndex ? e : [m, b.redips.cellIndex];
                    break;
                case "horizontal2":
                    c = c ===
                        d && a.parentNode.rowIndex === b.parentNode.rowIndex ? e : [b.redips.rowIndex, o];
                    break;
                default:
                    c = c === d ? e : [m, o]
            }
            "vertical1" === f || "vertical2" === f ? (f = 1E3 * c[1] + c[0] < 1E3 * g[1] + g[0] ? 1 : -1, d = m, m = 0, o = 1) : (f = 1E3 * c[0] + c[1] < 1E3 * g[0] + g[1] ? 1 : -1, d = o, m = 1, o = 0);
            for (c[0] !== e[0] && c[1] !== e[1] && (p = !0); c[0] !== g[0] || c[1] !== g[1];)(h = i[c[0] + "-" + c[1]], c[m] += f, 0 > c[m] ? (c[m] = d, c[o]--) : c[m] > d && (c[m] = 0, c[o]++), e = i[c[0] + "-" + c[1]], void 0 !== e && (j = e), void 0 !== h && (k = h), void 0 !== e && void 0 !== k || void 0 !== j && void 0 !== h) ? (e = -1 === j.className.indexOf(REDIPS.drag.mark.cname) ?
                0 : 1, h = -1 === k.className.indexOf(REDIPS.drag.mark.cname) ? 0 : 1, p && 0 === e && 1 === h && r(j), 1 === e ? 0 === h && (n = k) : (0 === e && 1 === h && (k = n), q(j, k))) : p && (void 0 !== j && void 0 === k) && (e = -1 === j.className.indexOf(REDIPS.drag.mark.cname) ? 0 : 1, 0 === e && r(j))
        }
    };
    Na = function (a) {
        var b = [], c, d = {}, e, g, f, i, h, j, k, l;
        i = a.rows;
        for (h = 0; h < i.length; h++)for (j = 0; j < i[h].cells.length; j++) {
            c = i[h].cells[j];
            a = c.parentNode.rowIndex;
            e = c.rowSpan || 1;
            g = c.colSpan || 1;
            b[a] = b[a] || [];
            for (k = 0; k < b[a].length + 1; k++)if ("undefined" === typeof b[a][k]) {
                f = k;
                break
            }
            d[a +
                "-" + f] = c;
            void 0 === c.redips && (c.redips = {});
            c.redips.rowIndex = a;
            c.redips.cellIndex = f;
            for (k = a; k < a + e; k++) {
                b[k] = b[k] || [];
                c = b[k];
                for (l = f; l < f + g; l++)c[l] = "x"
            }
        }
        return d
    };
    Oa = function (a) {
        var b = a.rows, c = 0, d, e;
        "string" === typeof a && document.getElementById(a);
        for (d = 0; d < b.length; d++) {
            for (e = a = 0; e < b[d].cells.length; e++)a += b[d].cells[e].colSpan || 1;
            a > c && (c = a)
        }
        return c
    };
    Ha = function (a, b) {
        var c = (b.k1 - b.k2 * a) * (b.k1 - b.k2 * a), d, a = a + REDIPS.drag.animation.step * (4 - 3 * c) * b.direction;
        d = b.m * a + b.b;
        "horizontal" === b.type ? (b.obj.style.left =
            a + "px", b.obj.style.top = d + "px") : (b.obj.style.left = d + "px", b.obj.style.top = a + "px");
        a < b.last && 0 < b.direction || a > b.last && 0 > b.direction ? setTimeout(function () {
            Ha(a, b)
        }, REDIPS.drag.animation.pause * c) : (Ba(b.obj), b.obj.redips && (b.obj.redips.animated = !1), "cell" === b.mode ? (!0 === b.overwrite && ea(b.targetCell), b.targetCell.appendChild(b.obj), b.obj.redips && !1 !== b.obj.redips.enabled && U(b.obj)) : Ia(pa(b.target[0]), b.target[1], b.obj), "function" === typeof b.callback && b.callback(b.obj))
    };
    qa = function (a) {
        var b, c, d;
        b = [];
        b = c =
            d = -1;
        if (void 0 === a)b = j < f.length ? f[j].redips.idx : null === t || null === v || null === A ? f[z].redips.idx : f[t].redips.idx, c = f[z].redips.idx, b = [b, h, k, c, I, T]; else {
            if (a = "string" === typeof a ? document.getElementById(a) : a)"TD" !== a.nodeName && (a = x("TD", a)), a && "TD" === a.nodeName && (b = a.cellIndex, c = a.parentNode.rowIndex, a = x("TABLE", a), d = a.redips.idx);
            b = [d, c, b]
        }
        return b
    };
    pa = function (a) {
        var b;
        for (b = 0; b < f.length && f[b].redips.idx !== a; b++);
        return b
    };
    sa = function (a) {
        void 0 !== a && (a = a.replace(/^\s+|\s+$/g, "").replace(/\s{2,}/g, " "));
        return a
    };
    Qa = function (a) {
        var b;
        for (b = 0; b < a.childNodes.length; b++)if (1 === a.childNodes[b].nodeType)return!0;
        return!1
    };
    ra = function (a, b, c) {
        var d, e;
        "string" === typeof a && (a = document.getElementById(a), a = x("TABLE", a));
        if ("TR" === a.nodeName) {
            a = a.getElementsByTagName("td");
            for (d = 0; d < a.length; d++)if (a[d].style.backgroundColor = c ? c : "", "empty" === b)a[d].innerHTML = ""; else for (e = 0; e < a[d].childNodes.length; e++)1 === a[d].childNodes[e].nodeType && (a[d].childNodes[e].style.opacity = b / 100, a[d].childNodes[e].style.filter = "alpha(opacity=" +
                b + ")")
        } else a.style.opacity = b / 100, a.style.filter = "alpha(opacity=" + b + ")", a.style.backgroundColor = c ? c : ""
    };
    return{obj: i, objOld: m, mode: r, td: l, hover: {colorTd: "#E7AB83", colorTr: "#E7AB83"}, scroll: {enable: !0, bound: 25, speed: 20}, only: ya, mark: Ta, style: {borderEnabled: "solid", borderDisabled: "dotted", opacityDisabled: "", rowEmptyColor: "white"}, trash: {className: "trash", question: null, questionRow: null}, saveParamName: "p", dropMode: "multiple", multipleDrop: "bottom", clone: Ua, animation: {pause: 20, step: 2, shift: !1}, shift: {mode: "horizontal1",
        after: "default", overflow: "bunch"}, rowDropMode: "before", tableSort: !0, init: function (a) {
        var b;
        if (void 0 === a || "string" !== typeof a)a = "drag";
        y = document.getElementById(a);
        xa = K();
        document.getElementById("redips_clone") || (a = document.createElement("div"), a.id = "redips_clone", a.style.width = a.style.height = "1px", y.appendChild(a));
        B("init");
        q();
        Ca();
        REDIPS.event.add(window, "resize", Ca);
        b = y.getElementsByTagName("img");
        for (a = 0; a < b.length; a++)REDIPS.event.add(b[a], "mousemove", J), REDIPS.event.add(b[a], "touchmove", J);
        REDIPS.event.add(window, "scroll", u)
    }, initTables: q, enableDrag: B, enableTable: function (a, b) {
        var c;
        if ("object" === typeof b && "TABLE" === b.nodeName)b.redips.enabled = a; else for (c = 0; c < f.length; c++)-1 < f[c].className.indexOf(b) && (f[c].redips.enabled = a)
    }, cloneObject: ma, saveContent: function (a, b) {
        var c = "", d, e, f, h, i, j, k, l = [], m = REDIPS.drag.saveParamName;
        "string" === typeof a && (a = document.getElementById(a));
        if (void 0 !== a && "object" === typeof a && "TABLE" === a.nodeName) {
            d = a.rows.length;
            for (i = 0; i < d; i++) {
                e = a.rows[i].cells.length;
                for (j = 0; j < e; j++)if (f = a.rows[i].cells[j], 0 < f.childNodes.length)for (k = 0; k < f.childNodes.length; k++)h = f.childNodes[k], "DIV" === h.nodeName && -1 < h.className.indexOf("drag") && (c += m + "[]=" + h.id + "_" + i + "_" + j + "&", l.push([h.id, i, j]))
            }
            c = "json" === b && 0 < l.length ? JSON.stringify(l) : c.substring(0, c.length - 1)
        }
        return c
    }, relocate: da, emptyCell: ea, moveObject: function (a) {
        var b = {direction: 1}, c, d, e, g, i, h;
        b.callback = a.callback;
        b.overwrite = a.overwrite;
        "string" === typeof a.id ? b.obj = b.objOld = document.getElementById(a.id) : "object" === typeof a.obj && "DIV" === a.obj.nodeName && (b.obj = b.objOld = a.obj);
        if ("row" === a.mode) {
            b.mode = "row";
            h = pa(a.source[0]);
            i = a.source[1];
            m = b.objOld = f[h].rows[i];
            if (m.redips && !0 === m.redips.emptyRow)return!1;
            b.obj = fa(b.objOld, "animated")
        } else if (b.obj && -1 < b.obj.className.indexOf("row")) {
            b.mode = "row";
            b.obj = b.objOld = m = x("TR", b.obj);
            if (m.redips && !0 === m.redips.emptyRow)return!1;
            b.obj = fa(b.objOld, "animated")
        } else b.mode = "cell";
        if (!("object" !== typeof b.obj || null === b.obj))return b.obj.style.zIndex = 999, b.obj.redips && y !==
            b.obj.redips.container && (y = b.obj.redips.container, q()), h = C(b.obj), e = h[1] - h[3], g = h[2] - h[0], c = h[3], d = h[0], !0 === a.clone && "cell" === b.mode && (b.obj = ma(b.obj, !0), REDIPS.drag.event.cloned(b.obj)), void 0 === a.target ? a.target = qa() : "object" === typeof a.target && "TD" === a.target.nodeName && (a.target = qa(a.target)), b.target = a.target, h = pa(a.target[0]), i = a.target[1], a = a.target[2], i > f[h].rows.length - 1 && (i = f[h].rows.length - 1), b.targetCell = f[h].rows[i].cells[a], "cell" === b.mode ? (h = C(b.targetCell), i = h[1] - h[3], a = h[2] - h[0],
            e = h[3] + (i - e) / 2, g = h[0] + (a - g) / 2) : (h = C(f[h].rows[i]), e = h[3], g = h[0]), h = e - c, a = g - d, b.obj.style.position = "fixed", Math.abs(h) > Math.abs(a) ? (b.type = "horizontal", b.m = a / h, b.b = d - b.m * c, b.k1 = (c + e) / (c - e), b.k2 = 2 / (c - e), c > e && (b.direction = -1), h = c, b.last = e) : (b.type = "vertical", b.m = h / a, b.b = c - b.m * d, b.k1 = (d + g) / (d - g), b.k2 = 2 / (d - g), d > g && (b.direction = -1), h = d, b.last = g), b.obj.redips && (b.obj.redips.animated = !0), Ha(h, b), [b.obj, b.objOld]
    }, shiftCells: oa, deleteObject: function (a) {
        "object" === typeof a && "DIV" === a.nodeName ? a.parentNode.removeChild(a) :
            "string" === typeof a && (a = document.getElementById(a)) && a.parentNode.removeChild(a)
    }, getPosition: qa, rowOpacity: ra, rowEmpty: function (a, b, c) {
        a = document.getElementById(a).rows[b];
        void 0 === c && (c = REDIPS.drag.style.rowEmptyColor);
        void 0 === a.redips && (a.redips = {});
        a.redips.emptyRow = !0;
        ra(a, "empty", c)
    }, getScrollPosition: K, getStyle: E, findParent: x, findCell: Ga, event: {changed: function () {
    }, clicked: function () {
    }, cloned: function () {
    }, clonedDropped: function () {
    }, clonedEnd1: function () {
    }, clonedEnd2: function () {
    }, dblClicked: function () {
    },
        deleted: function () {
        }, dropped: function () {
        }, droppedBefore: function () {
        }, finish: function () {
        }, moved: function () {
        }, notCloned: function () {
        }, notMoved: function () {
        }, shiftOverflow: function () {
        }, relocateBefore: function () {
        }, relocateAfter: function () {
        }, relocateEnd: function () {
        }, rowChanged: function () {
        }, rowClicked: function () {
        }, rowCloned: function () {
        }, rowDeleted: function () {
        }, rowDropped: function () {
        }, rowDroppedBefore: function () {
        }, rowDroppedSource: function () {
        }, rowMoved: function () {
        }, rowNotCloned: function () {
        }, rowNotMoved: function () {
        },
        rowUndeleted: function () {
        }, switched: function () {
        }, undeleted: function () {
        }}}
}();
REDIPS.event || (REDIPS.event = function () {
    return{add: function (q, B, J) {
        q.addEventListener ? q.addEventListener(B, J, !1) : q.attachEvent ? q.attachEvent("on" + B, J) : q["on" + B] = J
    }, remove: function (q, B, J) {
        q.removeEventListener ? q.removeEventListener(B, J, !1) : q.detachEvent ? q.detachEvent("on" + B, J) : q["on" + B] = null
    }}
}());