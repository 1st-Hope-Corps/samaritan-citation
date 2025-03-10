//jQuery Translate plugin and related components

/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};


/*
 * jQuery nodesContainingText plugin
 * Version: 1.1.2
 * http://code.google.com/p/jquery-translate/
 * Copyright (c) 2009 Balazs Endresz (balazs.endresz@gmail.com)
 * Dual licensed under the MIT and GPL licenses.
 */
(function(b){function a(){}a.prototype={init:function(e,d){this.textArray=[];this.elements=[];this.options=d;this.jquery=e;this.n=-1;if(d.async===true){d.async=2}if(d.not){e=e.not(d.not);e=e.add(e.find("*").not(d.not)).not(b(d.not).find("*"))}else{e=e.add(e.find("*"))}this.jq=e;this.jql=this.jq.length;return this.process()},process:function(){this.n++;var i=this,d=this.options,p="",h=false,g=false,f=this.jq[this.n],k,m,j;if(this.n===this.jql){j=this.jquery.pushStack(this.elements,"nodesContainingText");d.complete.call(j,j,this.textArray);if(d.returnAll===false&&d.walk===false){return this.jquery}return j}if(!f){return this.process()}k=b(f);var n=f.nodeName.toUpperCase(),l=n==="INPUT"&&b.attr(f,"type").toLowerCase();if(({SCRIPT:1,NOSCRIPT:1,STYLE:1,OBJECT:1,IFRAME:1})[n]){return this.process()
}if(typeof d.subject==="string"){p=k.attr(d.subject)}else{if(d.altAndVal&&(n==="IMG"||l==="image")){p=k.attr("alt")}else{if(d.altAndVal&&({text:1,button:1,submit:1})[l]){p=k.val()}else{if(n==="TEXTAREA"){p=k.val()}else{m=f.firstChild;if(d.walk!==true){g=true}else{while(m){if(m.nodeType==1){g=true;break}m=m.nextSibling}}if(!g){p=k.text()}else{if(d.walk!==true){h=true}m=f.firstChild;while(m){if(m.nodeType==3&&m.nodeValue.match(/\S/)!==null){if(m.nodeValue.match(/<![ \r\n\t]*(--([^\-]|[\r\n]|-[^\-])*--[ \r\n\t]*)>/)!==null){if(m.nodeValue.match(/(\S+(?=.*<))|(>(?=.*\S+))/)!==null){h=true;break}}else{h=true;break}}m=m.nextSibling}if(h){p=k.html();p=d.stripScripts?p.replace(/<script[^>]*>([\s\S]*?)<\/script>/gi,""):p;this.jq=this.jq.not(k.find("*"))}}}}}}if(!p){return this.process()}this.elements.push(f);this.textArray.push(p);d.each.call(f,this.elements.length-1,f,p);if(d.async){setTimeout(function(){i.process()},d.async);return this.jquery}else{return this.process()}}};var c={not:"",async:false,each:function(){},complete:function(){},comments:false,returnAll:true,walk:true,altAndVal:false,subject:true,stripScripts:true};
b.fn.nodesContainingText=function(d){d=b.extend({},c,b.fn.nodesContainingText.defaults,d);return new a().init(this,d)};b.fn.nodesContainingText.defaults=c})(jQuery);
/*
 * jQuery Translate plugin
 * Version: 1.4.1
 * http://code.google.com/p/jquery-translate/
 * Copyright (c) 2009 Balazs Endresz (balazs.endresz@gmail.com)
 * Dual licensed under the MIT and GPL licenses.
 * This plugin uses the 'Google AJAX Language API' (http://code.google.com/apis/ajaxlanguage/)
 * You can read the terms of use at http://code.google.com/apis/ajaxlanguage/terms.html
 */
(function(c){function o(){}var d=true,g=false,e,s="".replace,m,k,f,p={},b,i=[],h={from:"",to:"",start:o,error:o,each:o,complete:o,onTimeout:o,timeout:0,stripComments:d,stripWhitespace:d,stripScripts:d,separators:/\.\?\!;:/,limit:1750,walk:d,returnAll:g,replace:d,rebind:d,data:d,setLangAttr:g,subject:d,not:"",altAndVal:d,async:g,toggle:g,fromOriginal:d};function r(){c.translate.GL=m=google.language;c.translate.GLL=k=m.Languages;f=c.translate.toLanguageCode;c.each(k,function(v,w){p[w.toUpperCase()]=v});c.translate.isReady=d;var u;while((u=i.shift())){u()}}function j(w,v){var u={};
c.each(w,function(x,y){if(v(y,x)===d){u[x]=y}});return u}function t(v,w,u){return function(){return v.apply(w===d?arguments[0]:w,u||arguments)}}function q(u){return u!==e}function n(w,x,v){w=c.grep(w,q);var u,y={};c.each(x,function(z,A){var B=c.grep(A[0],function(D,C){return q(w[C])&&w[C].constructor===D}).length;if(B===w.length&&B===A[0].length&&(u=d)){c.each(A[1],function(C,D){y[D]=w[C]});return g}});if(!u){throw v}return y}function l(x,w){var u=n(x,c.translate.overload,"jQuery.translate: Invalid arguments"),v=u.options||{};delete u.options;v=c.extend({},h,w,c.extend(v,u));if(v.fromOriginal){v.toggle=d}if(v.toggle){v.data=d}if(v.async===d){v.async=2}return v}function a(){this.extend(c.translate);delete this.defaults;delete this.fn}a.prototype={version:"1.4.1",_init:function(v,x){var w=x.separators.source||x.separators,u=this.isString=typeof v==="string";c.each(["stripComments","stripScripts","stripWhitespace"],function(z,y){var A=c.translate[y];if(x[y]){v=u?A(v):c.map(v,A)}});this.rawSource="<div>"+(u?v:v.join("</div><div>"))+"</div>";
this._m3=new RegExp("["+w+"](?![^"+w+"]*["+w+"])");this.options=x;this.from=x.from=f(x.from)||"";this.to=x.to=f(x.to)||"";this.source=v;this.rawTranslation="";this.translation=[];this.startPos=0;this.i=0;this.stopped=g;this.elements=x.nodes;x.start.call(this,v,x.from,x.to,x);if(x.timeout){this.timeout=setTimeout(t(x.onTimeout,this,[v,x.from,x.to,x]),x.timeout)}(x.toggle&&x.nodes)?this._toggle():this._process()},_process:function(){if(this.stopped){return}var u=this.options,y=this.rawTranslation.length,B,C,A,z;this.rawSourceSub=this.truncate(this.rawSource.substr(this.startPos),u.limit);this.startPos+=this.rawSourceSub.length;while((B=this.rawTranslation.lastIndexOf("</div>",y))>-1){y=B-1;C=this.rawTranslation.substr(0,y+1);A=C.match(/<div[> ]/gi);z=C.match(/<\/div>/gi);A=A?A.length:0;z=z?z.length:0;if(A!==z+1){continue}var v=c(this.rawTranslation.substr(0,y+7)),x=v.length,w=this.i;if(w===x){break}v.slice(w,x).each(t(function(D,G){if(this.stopped){return g}var F=c(G).html().replace(/^\s/,""),E=w+D,H=this.source,I=!this.from&&this.detectedSourceLanguage||this.from;
this.translation[E]=F;this.isString?this.translation=F:H=this.source[E];u.each.call(this,E,F,H,I,this.to,u);this.i++},this));break}if(this.rawSourceSub.length){this._translate()}else{this._complete()}},_translate:function(){m.translate(this.rawSourceSub,this.from,this.to,t(function(u){if(u.error){return this.options.error.call(this,u.error,this.rawSourceSub,this.from,this.to,this.options)}this.rawTranslation+=u.translation||this.rawSourceSub;this.detectedSourceLanguage=u.detectedSourceLanguage;this._process()},this))},_complete:function(){clearTimeout(this.timeout);this.options.complete.call(this,this.translation,this.source,!this.from&&this.detectedSourceLanguage||this.from,this.to,this.options)},stop:function(){if(this.stopped){return this}this.stopped=d;this.options.error.call(this,{message:"stopped"});return this}};c.translate=function(w,u){if(w==e){return new a()}if(c.isFunction(w)){return c.translate.ready(w,u)}var x=new a();var v=[].slice.call(arguments,0);v.shift();return c.translate.ready(t(x._init,x,[w,l(v,c.translate.defaults)]),g,x)
};c.translate.fn=c.translate.prototype=a.prototype;c.translate.fn.extend=c.translate.extend=c.extend;c.translate.extend({_bind:t,_filter:j,_validate:n,_getOpt:l,_defaults:h,defaults:c.extend({},h),capitalize:function(u){return u.charAt(0).toUpperCase()+u.substr(1).toLowerCase()},truncate:function(A,v){var w,D,B,z,y,C,u=encodeURIComponent(A);for(w=0;w<10;w++){try{C=decodeURIComponent(u.substr(0,v-w))}catch(x){continue}if(C){break}}return(!(D=/<(?![^<]*>)/.exec(C)))?((!(B=/>\s*$/.exec(C)))?((z=this._m3.exec(C))?((y=/>(?![^>]*<)/.exec(C))?(z.index>y.index?C.substring(0,z.index+1):C.substring(0,y.index+1)):C.substring(0,z.index+1)):C):C):C.substring(0,D.index)},getLanguages:function(B,A){if(B==e||(A==e&&!B)){return k}var y={},x=typeof B,w=A?c.translate.getLanguages(B):k,C=(x==="object"||x==="function")?B:A;if(C){if(C.call){y=j(w,C)}else{for(var z=0,v=C.length,u;z<v;z++){u=c.translate.toLanguage(C[z]);if(w[u]!=e){y[u]=w[u]}}}}else{y=j(k,m.isTranslatable)}return y},toLanguage:function(w,y){var x=w.toUpperCase();
var v=p[x]||(k[x]?x:e)||p[(c.translate.languageCodeMap[w.toLowerCase()]||"").toUpperCase()];return v==e?e:y==="lowercase"?v.toLowerCase():y==="capitalize"?c.translate.capitalize(v):v},toLanguageCode:function(u){return k[u]||k[c.translate.toLanguage(u)]||c.translate.languageCodeMap[u.toLowerCase()]},same:function(v,u){return v===u||f(v)===f(u)},isTranslatable:function(u){return m.isTranslatable(f(u))},languageCodeMap:{he:"iw",zlm:"ms","zh-hans":"zh-CN","zh-hant":"zh-TW"},isRtl:{ar:d,iw:d,fa:d,ur:d,yi:d},getBranding:function(){return c(m.getBranding.apply(m,arguments))},load:function(v,u){b=d;function w(){google.load("language",u||"1",{callback:r})}if(typeof google!=="undefined"&&google.load){w()}else{c.getScript("http://www.google.com/jsapi?"+(v?"key="+v:""),w)}return c.translate},ready:function(u,w,v){c.translate.isReady?u():i.push(u);if(!b&&!w){c.translate.load()}return v||c.translate},isReady:g,overload:[[[],[]],[[String,String,Object],["from","to","options"]],[[String,Object],["to","options"]],[[Object],["options"]],[[String,String],["from","to"]],[[String],["to"]],[[String,String,Function],["from","to","complete"]],[[String,Function],["to","complete"]]],stripScripts:t(s,d,[/<script[^>]*>([\s\S]*?)<\/script>/gi,""]),stripWhitespace:t(s,d,[/\s\s+/g," "]),stripComments:t(s,d,[/<![ \r\n\t]*(--([^\-]|[\r\n]|-[^\-])*--[ \r\n\t]*)>/g,""])})
})(jQuery);

(function(f){var e=true,a={text:e,button:e,submit:e},b={SCRIPT:e,NOSCRIPT:e,STYLE:e,OBJECT:e,IFRAME:e},d=f([]);d.length=1;function c(i,h){var j=i.css("text-align");i.css("direction",h);if(j==="right"){i.css("text-align","left")}if(j==="left"){i.css("text-align","right")}}function g(i,j){var k=i.nodeName.toUpperCase(),h=k==="INPUT"&&f.attr(i,"type").toLowerCase();j=j||{altAndVal:e,subject:e};return typeof j.subject==="string"?j.subject:j.altAndVal&&(k==="IMG"||h==="image")?"alt":j.altAndVal&&a[h]?"$val":k==="TEXTAREA"?"$val":"$html"}f.translate.fn._toggle=function(){var i=this.options,j=i.to,h;this.elements.each(f.translate._bind(function(k,l){this.i=k;var n=f(l),m=f.translate.getData(n,j,i);if(!m){return !(h=e)}this.translation.push(m);this.replace(n,m,j,i);this.setLangAttr(n,j,i);i.each.call(this,k,l,m,this.source[k],this.from,j,i)},this));
!h?this._complete():this._process()};f.translate.extend({_getType:g,each:function(j,l,h,k,p,n,m){d[0]=l;f.translate.setData(d,n,h,p,k,m);f.translate.replace(d,h,n,m);f.translate.setLangAttr(d,n,m)},getData:function(j,l,k){var h=j[0]||j,i=f.data(h,"translation");return i&&i[l]&&i[l][g(h,k)]},setData:function(k,m,p,n,q,h){if(h&&!h.data){return}var i=k[0]||k,l=g(i,h),j=f.data(i,"translation");j=j||f.data(i,"translation",{});(j[n]=j[n]||{})[l]=q;(j[m]=j[m]||{})[l]=p},replace:function(l,s,r,j){if(j&&!j.replace){return}if(j&&typeof j.subject==="string"){return l.attr(j.subject,s)}var k=l[0]||l,p=k.nodeName.toUpperCase(),n=p==="INPUT"&&f.attr(k,"type").toLowerCase(),m=f.translate.isRtl,i=f.data(k,"lang");if(i===r){return}if(m[r]!==m[i||j&&j.from]){if(m[r]){c(l,"rtl")}else{if(l.css("direction")==="rtl"){c(l,"ltr")}}}if((!j||j.altAndVal)&&(p==="IMG"||n==="image")){l.attr("alt",s)}else{if(p==="TEXTAREA"||(!j||j.altAndVal)&&a[n]){l.val(s)}else{if(!j||j.rebind){var h=l.find("*").not("script"),q=f("<div/>").html(s);
f.translate.copyEvents(h,q.find("*"));l.html(q.contents())}else{l.html(s)}}}f.data(k,"lang",r)},setLangAttr:function(h,j,i){if(!i||i.setLangAttr){h.attr((!i||i.setLangAttr===e)?"lang":i.setLangAttr,j)}},copyEvents:function(i,h){h.each(function(k,n){var o=i[k];if(!n||!o){return false}if(b[o.nodeName.toUpperCase()]){return e}var j=f.data(o,"events");if(!j){return e}for(var m in j){for(var l in j[m]){f.event.add(n,m,j[m][l],j[m][l].data)}}})}});f.fn.translate=function(i,h,l){var j=f.translate._getOpt(arguments,f.fn.translate.defaults),k=f.extend({},f.translate._defaults,f.fn.translate.defaults,j,{complete:function(n,m){f.translate(function(){var q=f.translate.toLanguageCode(j.from);if(j.fromOriginal){n.each(function(r,s){d[0]=s;var t=f.translate.getData(d,q,j);if(!t){return true}m[r]=t})}var p=j.each;function o(r){return function(){[].unshift.call(arguments,this.elements);r.apply(this,arguments)}}j.nodes=n;j.start=o(j.start);j.onTimeout=o(j.onTimeout);j.complete=o(j.complete);j.each=function(s){var r=arguments;
if(arguments.length!==7){[].splice.call(r,1,0,this.elements[s])}this.each.apply(this,r);p.apply(this,r)};f.translate(m,j)})},each:function(){}});if(this.nodesContainingText){return this.nodesContainingText(k)}j.nodes=this;f.translate(f.map(this,function(m){return f(m).html()||f(m).val()}),j);return this};f.fn.translate.defaults=f.extend({},f.translate._defaults)})(jQuery);

(function(a){var b={tags:["select","option"],filter:a.translate.isTranslatable,label:a.translate.toNativeLanguage||function(d,c){return a.translate.capitalize(c)},includeUnknown:false};a.translate.ui=function(){var g={},f="",d="",c="";if(typeof arguments[0]==="string"){g.tags=a.makeArray(arguments)}else{g=arguments[0]}g=a.extend({},b,a.translate.ui.defaults,g);if(g.tags[2]){d="<"+g.tags[2]+">";c="</"+g.tags[2]+">"}var e=a.translate.getLanguages(g.filter);if(!g.includeUnknown){delete e.UNKNOWN}a.each(e,function(h,i){f+=("<"+g.tags[1]+" value="+i+">"+d+g.label(i,h)+c+"</"+g.tags[1]+">")});return a("<"+g.tags[0]+' class="jq-translate-ui">'+f+"</"+g.tags[0]+">")};a.translate.ui.defaults=a.extend({},b)})(jQuery);