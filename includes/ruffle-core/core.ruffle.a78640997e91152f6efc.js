"use strict";(self.webpackChunkruffle_selfhosted=self.webpackChunkruffle_selfhosted||[]).push([[966],{762:(e,n,t)=>{function _(e,n){const t=e.length,_=e.getChannelData(0),r=e.getChannelData(1);let b=0,c=0;for(;c<t;)_[c]=n[b],r[c]=n[b+1],c++,b+=2}t.d(n,{tM:()=>_})},966:(e,n,t)=>{t.r(n),t.d(n,{Ruffle:()=>D,default:()=>q,initSync:()=>U});var _=t(762);e=t.hmd(e);const r="undefined"!=typeof AudioContext?AudioContext:"undefined"!=typeof webkitAudioContext?webkitAudioContext:void 0;let b;const c=new TextDecoder("utf-8",{ignoreBOM:!0,fatal:!0});c.decode();let o=new Uint8Array;function f(){return 0===o.byteLength&&(o=new Uint8Array(b.memory.buffer)),o}function i(e,n){return c.decode(f().subarray(e,e+n))}let u=0;const a=new TextEncoder("utf-8"),g="function"==typeof a.encodeInto?function(e,n){return a.encodeInto(e,n)}:function(e,n){const t=a.encode(e);return n.set(t),{read:e.length,written:t.length}};function w(e,n,t){if(void 0===t){const t=a.encode(e),_=n(t.length);return f().subarray(_,_+t.length).set(t),u=t.length,_}let _=e.length,r=n(_);const b=f();let c=0;for(;c<_;c++){const n=e.charCodeAt(c);if(n>127)break;b[r+c]=n}if(c!==_){0!==c&&(e=e.slice(c)),r=t(r,_,_=c+3*e.length);const n=f().subarray(r+c,r+_);c+=g(e,n).written}return u=c,r}let d=new Int32Array;function s(){return 0===d.byteLength&&(d=new Int32Array(b.memory.buffer)),d}function l(e){return null==e}let m=new Float64Array;function p(){return 0===m.byteLength&&(m=new Float64Array(b.memory.buffer)),m}function y(e){const n=typeof e;if("number"==n||"boolean"==n||null==e)return`${e}`;if("string"==n)return`"${e}"`;if("symbol"==n){const n=e.description;return null==n?"Symbol":`Symbol(${n})`}if("function"==n){const n=e.name;return"string"==typeof n&&n.length>0?`Function(${n})`:"Function"}if(Array.isArray(e)){const n=e.length;let t="[";n>0&&(t+=y(e[0]));for(let _=1;_<n;_++)t+=", "+y(e[_]);return t+="]",t}const t=/\[object ([^\]]+)\]/.exec(toString.call(e));let _;if(!(t.length>1))return toString.call(e);if(_=t[1],"Object"==_)try{return"Object("+JSON.stringify(e)+")"}catch(e){return"Object"}return e instanceof Error?`${e.name}: ${e.message}\n${e.stack}`:_}function h(e,n,t,_){const r={a:e,b:n,cnt:1,dtor:t},c=(...e)=>{r.cnt++;const n=r.a;r.a=0;try{return _(n,r.b,...e)}finally{0==--r.cnt?b.__wbindgen_export_3.get(r.dtor)(n,r.b):r.a=n}};return c.original=r,c}function v(e,n,t){b.closure389_externref_shim(e,n,t)}function x(e,n,t){b._dyn_core__ops__function__FnMut__A____Output___R_as_wasm_bindgen__closure__WasmClosure___describe__invoke__he1e245887bb5ec67(e,n,t)}function A(e,n){b._dyn_core__ops__function__FnMut_____Output___R_as_wasm_bindgen__closure__WasmClosure___describe__invoke__h9c92a777cd0506f8(e,n)}function S(e,n,t){b.closure2817_externref_shim(e,n,t)}function C(e){const n=b.__externref_table_alloc();return b.__wbindgen_export_2.set(n,e),n}function R(e,n){try{return e.apply(this,n)}catch(e){const n=C(e);b.__wbindgen_exn_store(n)}}function T(e){const n=b.__wbindgen_export_2.get(e);return b.__externref_table_dealloc(e),n}let E=new Uint32Array;let F=new Float32Array;function P(e,n){return(0===F.byteLength&&(F=new Float32Array(b.memory.buffer)),F).subarray(e/4,e/4+n)}function k(e,n){return f().subarray(e/1,e/1+n)}function M(e,n){return p().subarray(e/8,e/8+n)}function L(e){return()=>{throw new Error(`${e} is not defined`)}}let O=new Uint8ClampedArray;function I(e,n){return(0===O.byteLength&&(O=new Uint8ClampedArray(b.memory.buffer)),O).subarray(e/1,e/1+n)}class D{static __wrap(e){const n=Object.create(D.prototype);return n.ptr=e,n}__destroy_into_raw(){const e=this.ptr;return this.ptr=0,e}free(){const e=this.__destroy_into_raw();b.__wbg_ruffle_free(e)}constructor(e,n,t){return b.ruffle_new(e,n,t)}stream_from(e,n){try{const _=b.__wbindgen_add_to_stack_pointer(-16),r=w(e,b.__wbindgen_malloc,b.__wbindgen_realloc),c=u;b.ruffle_stream_from(_,this.ptr,r,c,n);var t=s()[_/4+0];if(s()[_/4+1])throw T(t)}finally{b.__wbindgen_add_to_stack_pointer(16)}}load_data(e,n){try{const _=b.__wbindgen_add_to_stack_pointer(-16);b.ruffle_load_data(_,this.ptr,e,n);var t=s()[_/4+0];if(s()[_/4+1])throw T(t)}finally{b.__wbindgen_add_to_stack_pointer(16)}}play(){b.ruffle_play(this.ptr)}pause(){b.ruffle_pause(this.ptr)}is_playing(){return 0!==b.ruffle_is_playing(this.ptr)}volume(){return b.ruffle_volume(this.ptr)}set_volume(e){b.ruffle_set_volume(this.ptr,e)}prepare_context_menu(){return b.ruffle_prepare_context_menu(this.ptr)}run_context_menu_callback(e){b.ruffle_run_context_menu_callback(this.ptr,e)}set_fullscreen(e){b.ruffle_set_fullscreen(this.ptr,e)}clear_custom_menu_items(){b.ruffle_clear_custom_menu_items(this.ptr)}destroy(){b.ruffle_destroy(this.ptr)}call_exposed_callback(e,n){const t=w(e,b.__wbindgen_malloc,b.__wbindgen_realloc),_=u,r=function(e,n){const t=n(4*e.length),_=(0===E.byteLength&&(E=new Uint32Array(b.memory.buffer)),E);for(let n=0;n<e.length;n++)_[t/4+n]=C(e[n]);return u=e.length,t}(n,b.__wbindgen_malloc),c=u;return b.ruffle_call_exposed_callback(this.ptr,t,_,r,c)}set_trace_observer(e){b.ruffle_set_trace_observer(this.ptr,e)}audio_context(){return b.ruffle_audio_context(this.ptr)}static is_wasm_simd_used(){return 0!==b.ruffle_is_wasm_simd_used()}}function W(){const n={wbg:{}};return n.wbg.__wbg_new_df6e6ab7a65c4c4d=function(e,n){return new Error(i(e,n))},n.wbg.__wbg_panic_bbc809dd04a12c60=function(e,n){e.panic(n)},n.wbg.__wbindgen_is_function=function(e){return"function"==typeof e},n.wbg.__wbindgen_string_new=function(e,n){return i(e,n)},n.wbg.__wbg_ruffle_new=function(e){return D.__wrap(e)},n.wbg.__wbindgen_json_parse=function(e,n){return JSON.parse(i(e,n))},n.wbg.__wbindgen_json_serialize=function(e,n){const t=n,_=w(JSON.stringify(void 0===t?null:t),b.__wbindgen_malloc,b.__wbindgen_realloc),r=u;s()[e/4+1]=r,s()[e/4+0]=_},n.wbg.__wbindgen_cb_drop=function(e){const n=e.original;return 1==n.cnt--&&(n.a=0,!0)},n.wbg.__wbindgen_error_new=function(e,n){return new Error(i(e,n))},n.wbg.__wbg_setMetadata_bbaeaee7f48274e6=function(e,n){e.setMetadata(n)},n.wbg.__wbg_onCallbackAvailable_3a48fae397926c96=function(e,n,t){e.onCallbackAvailable(i(n,t))},n.wbg.__wbg_onFSCommand_fb2f94653f71796e=function(){return R((function(e,n,t,_,r){return e.onFSCommand(i(n,t),i(_,r))}),arguments)},n.wbg.__wbindgen_number_get=function(e,n){const t="number"==typeof n?n:void 0;p()[e/8+1]=l(t)?0:t,s()[e/4+0]=!l(t)},n.wbg.__wbindgen_string_get=function(e,n){const t="string"==typeof n?n:void 0;var _=l(t)?0:w(t,b.__wbindgen_malloc,b.__wbindgen_realloc),r=u;s()[e/4+1]=r,s()[e/4+0]=_},n.wbg.__wbindgen_boolean_get=function(e){return"boolean"==typeof e?e?1:0:2},n.wbg.__wbindgen_number_new=function(e){return e},n.wbg.__wbg_displayUnsupportedMessage_a8f81a8e054e5e91=function(e){e.displayUnsupportedMessage()},n.wbg.__wbg_displayRootMovieDownloadFailedMessage_1a5c34096259685a=function(e){e.displayRootMovieDownloadFailedMessage()},n.wbg.__wbg_displayMessage_c57c20204892da2b=function(e,n,t){e.displayMessage(i(n,t))},n.wbg.__wbg_setFullscreen_9819a8b20564e39b=function(){return R((function(e,n){e.setFullscreen(0!==n)}),arguments)},n.wbg.__wbg_copyToAudioBufferInterleaved_def95cf95dccde8c=function(e,n,t){(0,_.tM)(e,P(n,t))},n.wbg.__wbg_new_693216e109162396=function(){return new Error},n.wbg.__wbg_stack_0ddaca5d1abfb52f=function(e,n){const t=w(n.stack,b.__wbindgen_malloc,b.__wbindgen_realloc),_=u;s()[e/4+1]=_,s()[e/4+0]=t},n.wbg.__wbg_error_09919627ac0992f5=function(e,n){try{console.error(i(e,n))}finally{b.__wbindgen_free(e,n)}},n.wbg.__wbindgen_is_undefined=function(e){return void 0===e},n.wbg.__wbg_process_e56fd54cf6319b6c=function(e){return e.process},n.wbg.__wbindgen_is_object=function(e){return"object"==typeof e&&null!==e},n.wbg.__wbg_versions_77e21455908dad33=function(e){return e.versions},n.wbg.__wbg_node_0dd25d832e4785d5=function(e){return e.node},n.wbg.__wbindgen_is_string=function(e){return"string"==typeof e},n.wbg.__wbg_static_accessor_NODE_MODULE_26b231378c1be7dd=function(){return e},n.wbg.__wbg_require_0db1598d9ccecb30=function(){return R((function(e,n,t){return e.require(i(n,t))}),arguments)},n.wbg.__wbg_crypto_b95d7173266618a9=function(e){return e.crypto},n.wbg.__wbg_msCrypto_5a86d77a66230f81=function(e){return e.msCrypto},n.wbg.__wbg_getRandomValues_b14734aa289bc356=function(){return R((function(e,n){e.getRandomValues(n)}),arguments)},n.wbg.__wbg_randomFillSync_91e2b39becca6147=function(){return R((function(e,n,t){e.randomFillSync(k(n,t))}),arguments)},n.wbg.__wbg_instanceof_WebGl2RenderingContext_f43c52e5e19f2606=function(e){return e instanceof WebGL2RenderingContext},n.wbg.__wbg_bindVertexArray_93c9ea4c521c6150=function(e,n){e.bindVertexArray(n)},n.wbg.__wbg_blitFramebuffer_6d99f41ef1c9032f=function(e,n,t,_,r,b,c,o,f,i,u){e.blitFramebuffer(n,t,_,r,b,c,o,f,i>>>0,u>>>0)},n.wbg.__wbg_createVertexArray_f8aff8c98a8e7ce7=function(e){const n=e.createVertexArray();return l(n)?0:C(n)},n.wbg.__wbg_renderbufferStorageMultisample_2fddc7b0cc405fe4=function(e,n,t,_,r,b){e.renderbufferStorageMultisample(n>>>0,t,_>>>0,r,b)},n.wbg.__wbg_texImage2D_e7d46024e2946907=function(){return R((function(e,n,t,_,r,b,c,o,f,i,u){e.texImage2D(n>>>0,t,_,r,b,c,o>>>0,f>>>0,0===i?void 0:k(i,u))}),arguments)},n.wbg.__wbg_bindFramebuffer_8fa07aa65dcbd3aa=function(e,n,t){e.bindFramebuffer(n>>>0,t)},n.wbg.__wbg_bindRenderbuffer_8969ae2581d424bd=function(e,n,t){e.bindRenderbuffer(n>>>0,t)},n.wbg.__wbg_bindTexture_83f436ae22ba78b4=function(e,n,t){e.bindTexture(n>>>0,t)},n.wbg.__wbg_createFramebuffer_1316a4c02803bcf8=function(e){const n=e.createFramebuffer();return l(n)?0:C(n)},n.wbg.__wbg_createRenderbuffer_abb5d5ff42fa138f=function(e){const n=e.createRenderbuffer();return l(n)?0:C(n)},n.wbg.__wbg_createTexture_1b5ac8ef80f089c8=function(e){const n=e.createTexture();return l(n)?0:C(n)},n.wbg.__wbg_deleteFramebuffer_48183bac844e2cbe=function(e,n){e.deleteFramebuffer(n)},n.wbg.__wbg_deleteRenderbuffer_92abd3c5070fbbb9=function(e,n){e.deleteRenderbuffer(n)},n.wbg.__wbg_deleteTexture_8cb16fb3b8ab69cd=function(e,n){e.deleteTexture(n)},n.wbg.__wbg_framebufferRenderbuffer_4e682abcb3678a20=function(e,n,t,_,r){e.framebufferRenderbuffer(n>>>0,t>>>0,_>>>0,r)},n.wbg.__wbg_framebufferTexture2D_fd6329e64dacca57=function(e,n,t,_,r,b){e.framebufferTexture2D(n>>>0,t>>>0,_>>>0,r,b)},n.wbg.__wbg_getError_2d3fe8b71c072eda=function(e){return e.getError()},n.wbg.__wbg_getParameter_00d59df03350c8de=function(){return R((function(e,n){return e.getParameter(n>>>0)}),arguments)},n.wbg.__wbg_texParameteri_d3d72cea09b18227=function(e,n,t,_){e.texParameteri(n>>>0,t>>>0,_)},n.wbg.__wbg_instanceof_Window_a2a08d3918d7d4d0=function(e){return e instanceof Window},n.wbg.__wbg_document_14a383364c173445=function(e){const n=e.document;return l(n)?0:C(n)},n.wbg.__wbg_location_3b5031b281e8d218=function(e){return e.location},n.wbg.__wbg_devicePixelRatio_85ae9a993f96e777=function(e){return e.devicePixelRatio},n.wbg.__wbg_localStorage_2409bbdfe5a4d2a7=function(){return R((function(e){const n=e.localStorage;return l(n)?0:C(n)}),arguments)},n.wbg.__wbg_cancelAnimationFrame_0751dd622bd4f521=function(){return R((function(e,n){e.cancelAnimationFrame(n)}),arguments)},n.wbg.__wbg_focus_9b223127d6e50a79=function(){return R((function(e){e.focus()}),arguments)},n.wbg.__wbg_open_ab0998e8eb242a30=function(){return R((function(e,n,t,_,r){const b=e.open(i(n,t),i(_,r));return l(b)?0:C(b)}),arguments)},n.wbg.__wbg_requestAnimationFrame_61bcf77211b282b7=function(){return R((function(e,n){return e.requestAnimationFrame(n)}),arguments)},n.wbg.__wbg_fetch_23507368eed8d838=function(e,n){return e.fetch(n)},n.wbg.__wbg_setProperty_88447bf87ac638d7=function(){return R((function(e,n,t,_,r){e.setProperty(i(n,t),i(_,r))}),arguments)},n.wbg.__wbg_protocol_7652393e06791937=function(){return R((function(e,n){const t=w(n.protocol,b.__wbindgen_malloc,b.__wbindgen_realloc),_=u;s()[e/4+1]=_,s()[e/4+0]=t}),arguments)},n.wbg.__wbg_assign_4726eabf9448fa32=function(){return R((function(e,n,t){e.assign(i(n,t))}),arguments)},n.wbg.__wbg_offsetX_20394816af6b15d9=function(e){return e.offsetX},n.wbg.__wbg_offsetY_23315c976b0ac2ae=function(e){return e.offsetY},n.wbg.__wbg_button_943ba4d0c28109da=function(e){return e.button},n.wbg.__wbg_destination_5bc469ae2192967b=function(e){return e.destination},n.wbg.__wbg_sampleRate_07300b65434459c1=function(e){return e.sampleRate},n.wbg.__wbg_currentTime_5862ab7e6ff545eb=function(e){return e.currentTime},n.wbg.__wbg_new_e2e737399e087a85=function(){return R((function(){return new r}),arguments)},n.wbg.__wbg_close_b4a035e1d78e3210=function(){return R((function(e){return e.close()}),arguments)},n.wbg.__wbg_suspend_cd50f19e2a5135a2=function(){return R((function(e){return e.suspend()}),arguments)},n.wbg.__wbg_createBuffer_4d396c7e99dd4d2a=function(){return R((function(e,n,t,_){return e.createBuffer(n>>>0,t>>>0,_)}),arguments)},n.wbg.__wbg_createBufferSource_45686af9ad60716f=function(){return R((function(e){return e.createBufferSource()}),arguments)},n.wbg.__wbg_resume_4b659cb2e2765df8=function(){return R((function(e){return e.resume()}),arguments)},n.wbg.__wbg_bindVertexArrayOES_b53b8137f0e6f9e1=function(e,n){e.bindVertexArrayOES(n)},n.wbg.__wbg_createVertexArrayOES_56337c7d4798d96b=function(e){const n=e.createVertexArrayOES();return l(n)?0:C(n)},n.wbg.__wbg_new_e2a145651668d22b=function(){return R((function(){return new Path2D}),arguments)},n.wbg.__wbg_addPath_e0df7c5ccdae8168=function(e,n,t){e.addPath(n,t)},n.wbg.__wbg_closePath_dcda5ae9e0db0d5e=function(e){e.closePath()},n.wbg.__wbg_lineTo_22b9d8be98d56182=function(e,n,t){e.lineTo(n,t)},n.wbg.__wbg_moveTo_7f059fbc0c6c8424=function(e,n,t){e.moveTo(n,t)},n.wbg.__wbg_quadraticCurveTo_d8cbb5d19125b688=function(e,n,t,_,r){e.quadraticCurveTo(n,t,_,r)},n.wbg.__wbg_rect_818027622ba9aa48=function(e,n,t,_,r){e.rect(n,t,_,r)},n.wbg.__wbg_deltaY_e3158374108000c8=function(e){return e.deltaY},n.wbg.__wbg_deltaMode_78fa2eac67504e1e=function(e){return e.deltaMode},n.wbg.__wbg_connect_633555bc7344598d=function(){return R((function(e,n){return e.connect(n)}),arguments)},n.wbg.__wbg_setTransform_2c1f1d5821ce9694=function(e,n){e.setTransform(n)},n.wbg.__wbg_instanceof_HtmlFormElement_7e3c5f7169b9ec9c=function(e){return e instanceof HTMLFormElement},n.wbg.__wbg_submit_ae549d5b993be5ce=function(){return R((function(e){e.submit()}),arguments)},n.wbg.__wbg_pointerId_3517dc72b60101cb=function(e){return e.pointerId},n.wbg.__wbg_instanceof_Response_e928c54c1025470c=function(e){return e instanceof Response},n.wbg.__wbg_url_0f82030e7245954c=function(e,n){const t=w(n.url,b.__wbindgen_malloc,b.__wbindgen_realloc),_=u;s()[e/4+1]=_,s()[e/4+0]=t},n.wbg.__wbg_ok_2e44e661aa8fedb0=function(e){return e.ok},n.wbg.__wbg_statusText_9b7d7bb057846e45=function(e,n){const t=w(n.statusText,b.__wbindgen_malloc,b.__wbindgen_realloc),_=u;s()[e/4+1]=_,s()[e/4+0]=t},n.wbg.__wbg_arrayBuffer_9c26a73988618f92=function(){return R((function(e){return e.arrayBuffer()}),arguments)},n.wbg.__wbg_setbuffer_268b8e029383d924=function(e,n){e.buffer=n},n.wbg.__wbg_setonended_519c00ee657450cf=function(e,n){e.onended=n},n.wbg.__wbg_start_0548a4ae2ce0fcbd=function(){return R((function(e,n){e.start(n)}),arguments)},n.wbg.__wbg_now_9c64828adecad05e=function(e){return e.now()},n.wbg.__wbg_a_f8a23157db40a300=function(e){return e.a},n.wbg.__wbg_seta_5cd98d661ce16283=function(e,n){e.a=n},n.wbg.__wbg_b_0d5d58541358976b=function(e){return e.b},n.wbg.__wbg_c_a90f0b5bdc175e78=function(e){return e.c},n.wbg.__wbg_d_e464989627f07979=function(e){return e.d},n.wbg.__wbg_setd_8a679c3670b6f49b=function(e,n){e.d=n},n.wbg.__wbg_e_9f858429eb0a621e=function(e){return e.e},n.wbg.__wbg_f_c5253bae312ccc71=function(e){return e.f},n.wbg.__wbg_new_adbe707b014d1fd2=function(){return R((function(){return new DOMMatrix}),arguments)},n.wbg.__wbg_newwitharray64_e834f62cea0c8cc5=function(){return R((function(e,n){return new DOMMatrix(M(e,n))}),arguments)},n.wbg.__wbg_currentTarget_6f25dd2ce13178de=function(e){const n=e.currentTarget;return l(n)?0:C(n)},n.wbg.__wbg_preventDefault_2e92eb64f38efc0d=function(e){e.preventDefault()},n.wbg.__wbg_addEventListener_5822223857fe82cb=function(){return R((function(e,n,t,_){e.addEventListener(i(n,t),_)}),arguments)},n.wbg.__wbg_addEventListener_a77a92f38176616e=function(){return R((function(e,n,t,_,r){e.addEventListener(i(n,t),_,r)}),arguments)},n.wbg.__wbg_addEventListener_a09abdb50db3cd98=function(){return R((function(e,n,t,_,r){e.addEventListener(i(n,t),_,0!==r)}),arguments)},n.wbg.__wbg_removeEventListener_0e2fd54517fc188b=function(){return R((function(e,n,t,_){e.removeEventListener(i(n,t),_)}),arguments)},n.wbg.__wbg_removeEventListener_2882dfde82b5b4d9=function(){return R((function(e,n,t,_,r){e.removeEventListener(i(n,t),_,0!==r)}),arguments)},n.wbg.__wbg_instanceof_HtmlCanvasElement_7b561bd94e483f1d=function(e){return e instanceof HTMLCanvasElement},n.wbg.__wbg_width_ad2acb326fc35bdb=function(e){return e.width},n.wbg.__wbg_setwidth_59ddc312219f205b=function(e,n){e.width=n>>>0},n.wbg.__wbg_height_65ee0c47b0a97297=function(e){return e.height},n.wbg.__wbg_setheight_70833966b4ed584e=function(e,n){e.height=n>>>0},n.wbg.__wbg_getContext_b506f48cb166bf26=function(){return R((function(e,n,t){const _=e.getContext(i(n,t));return l(_)?0:C(_)}),arguments)},n.wbg.__wbg_getContext_686f3aabd97ba151=function(){return R((function(e,n,t,_){const r=e.getContext(i(n,t),_);return l(r)?0:C(r)}),arguments)},n.wbg.__wbg_key_6e807abe0dbacdb8=function(e,n){const t=w(n.key,b.__wbindgen_malloc,b.__wbindgen_realloc),_=u;s()[e/4+1]=_,s()[e/4+0]=t},n.wbg.__wbg_code_ec695f278753de4d=function(e,n){const t=w(n.code,b.__wbindgen_malloc,b.__wbindgen_realloc),_=u;s()[e/4+1]=_,s()[e/4+0]=t},n.wbg.__wbg_newwithstrandinit_41c86e821f771b24=function(){return R((function(e,n,t){return new Request(i(e,n),t)}),arguments)},n.wbg.__wbg_body_36a11f2467926b2b=function(e){const n=e.body;return l(n)?0:C(n)},n.wbg.__wbg_createElement_2d8b75cffbd32c70=function(){return R((function(e,n,t){return e.createElement(i(n,t))}),arguments)},n.wbg.__wbg_createElementNS_02b4562aadf76190=function(){return R((function(e,n,t,_,r){return e.createElementNS(0===n?void 0:i(n,t),i(_,r))}),arguments)},n.wbg.__wbg_setid_c3cb9fedad5d2791=function(e,n,t){e.id=i(n,t)},n.wbg.__wbg_clientWidth_ff949ad9c6d41cd2=function(e){return e.clientWidth},n.wbg.__wbg_clientHeight_a250dcf2e0afa47a=function(e){return e.clientHeight},n.wbg.__wbg_querySelector_a38de55d3f2e4d6b=function(){return R((function(e,n,t){const _=e.querySelector(i(n,t));return l(_)?0:C(_)}),arguments)},n.wbg.__wbg_releasePointerCapture_13317581046e37c3=function(){return R((function(e,n){e.releasePointerCapture(n)}),arguments)},n.wbg.__wbg_setAttribute_6091f6f3602fc299=function(){return R((function(e,n,t,_,r){e.setAttribute(i(n,t),i(_,r))}),arguments)},n.wbg.__wbg_setAttributeNS_3139623dfaef606b=function(){return R((function(e,n,t,_,r,b,c){e.setAttributeNS(0===n?void 0:i(n,t),i(_,r),i(b,c))}),arguments)},n.wbg.__wbg_setPointerCapture_dee49a07994f6e33=function(){return R((function(e,n){e.setPointerCapture(n)}),arguments)},n.wbg.__wbg_remove_c64fe8f390b51079=function(e){e.remove()},n.wbg.__wbg_instanceof_WebGlRenderingContext_79048c0314cf40c7=function(e){return e instanceof WebGLRenderingContext},n.wbg.__wbg_drawingBufferWidth_2a4ec0e9cfd1165f=function(e){return e.drawingBufferWidth},n.wbg.__wbg_drawingBufferHeight_64a411586cabb96c=function(e){return e.drawingBufferHeight},n.wbg.__wbg_bufferData_1ca9a3b086d4f813=function(e,n,t,_,r){e.bufferData(n>>>0,k(t,_),r>>>0)},n.wbg.__wbg_texImage2D_e8ea990c77c01b05=function(){return R((function(e,n,t,_,r,b,c,o,f,i,u){e.texImage2D(n>>>0,t,_,r,b,c,o>>>0,f>>>0,0===i?void 0:k(i,u))}),arguments)},n.wbg.__wbg_uniform1fv_ffdaf3c465cd6435=function(e,n,t,_){e.uniform1fv(n,P(t,_))},n.wbg.__wbg_uniform4fv_f6890ad8a7ff6086=function(e,n,t,_){e.uniform4fv(n,P(t,_))},n.wbg.__wbg_uniformMatrix3fv_7969af8b5719ac05=function(e,n,t,_,r){e.uniformMatrix3fv(n,0!==t,P(_,r))},n.wbg.__wbg_uniformMatrix4fv_350ada82fee5cc68=function(e,n,t,_,r){e.uniformMatrix4fv(n,0!==t,P(_,r))},n.wbg.__wbg_activeTexture_c32bcd0a63a09c15=function(e,n){e.activeTexture(n>>>0)},n.wbg.__wbg_attachShader_772486952587993d=function(e,n,t){e.attachShader(n,t)},n.wbg.__wbg_bindBuffer_6cd1a268e0421a46=function(e,n,t){e.bindBuffer(n>>>0,t)},n.wbg.__wbg_bindFramebuffer_934b8eade9d43fe0=function(e,n,t){e.bindFramebuffer(n>>>0,t)},n.wbg.__wbg_bindRenderbuffer_e5cd7424d91a17d5=function(e,n,t){e.bindRenderbuffer(n>>>0,t)},n.wbg.__wbg_bindTexture_b3162b3f55caf7eb=function(e,n,t){e.bindTexture(n>>>0,t)},n.wbg.__wbg_blendEquationSeparate_cdb99fb43e079594=function(e,n,t){e.blendEquationSeparate(n>>>0,t>>>0)},n.wbg.__wbg_blendFuncSeparate_7b5ab5663d1a17c6=function(e,n,t,_,r){e.blendFuncSeparate(n>>>0,t>>>0,_>>>0,r>>>0)},n.wbg.__wbg_clear_fe06235bcda1a904=function(e,n){e.clear(n>>>0)},n.wbg.__wbg_clearColor_53d69d875a21f3f3=function(e,n,t,_,r){e.clearColor(n,t,_,r)},n.wbg.__wbg_colorMask_efa17a5ffd9cd3fc=function(e,n,t,_,r){e.colorMask(0!==n,0!==t,0!==_,0!==r)},n.wbg.__wbg_compileShader_4b64c51ce6f0d0be=function(e,n){e.compileShader(n)},n.wbg.__wbg_createBuffer_ae5a57822b3d261c=function(e){const n=e.createBuffer();return l(n)?0:C(n)},n.wbg.__wbg_createProgram_97d3ab796f2e4f2a=function(e){const n=e.createProgram();return l(n)?0:C(n)},n.wbg.__wbg_createShader_47c8c7b5a08a528d=function(e,n){const t=e.createShader(n>>>0);return l(t)?0:C(t)},n.wbg.__wbg_createTexture_ce8ff62039834d9c=function(e){const n=e.createTexture();return l(n)?0:C(n)},n.wbg.__wbg_disable_5d988b6430f67f00=function(e,n){e.disable(n>>>0)},n.wbg.__wbg_disableVertexAttribArray_37add1973be851f6=function(e,n){e.disableVertexAttribArray(n>>>0)},n.wbg.__wbg_drawElements_c18d01e29e69ee7f=function(e,n,t,_,r){e.drawElements(n>>>0,t,_>>>0,r)},n.wbg.__wbg_enable_74fb1401e1f17f16=function(e,n){e.enable(n>>>0)},n.wbg.__wbg_enableVertexAttribArray_0c2fc2819912f6b3=function(e,n){e.enableVertexAttribArray(n>>>0)},n.wbg.__wbg_getAttribLocation_b2bad8a5b6116f1f=function(e,n,t,_){return e.getAttribLocation(n,i(t,_))},n.wbg.__wbg_getExtension_6cd75531325282b8=function(){return R((function(e,n,t){const _=e.getExtension(i(n,t));return l(_)?0:C(_)}),arguments)},n.wbg.__wbg_getParameter_d30fc1ac9ac34ffc=function(){return R((function(e,n){return e.getParameter(n>>>0)}),arguments)},n.wbg.__wbg_getProgramInfoLog_07f10e11eb541319=function(e,n,t){const _=n.getProgramInfoLog(t);var r=l(_)?0:w(_,b.__wbindgen_malloc,b.__wbindgen_realloc),c=u;s()[e/4+1]=c,s()[e/4+0]=r},n.wbg.__wbg_getProgramParameter_ceb4cfbc03f7a74b=function(e,n,t){return e.getProgramParameter(n,t>>>0)},n.wbg.__wbg_getShaderInfoLog_6788bbcb07e46591=function(e,n,t){const _=n.getShaderInfoLog(t);var r=l(_)?0:w(_,b.__wbindgen_malloc,b.__wbindgen_realloc),c=u;s()[e/4+1]=c,s()[e/4+0]=r},n.wbg.__wbg_getUniformLocation_c6dfe99dcd260a55=function(e,n,t,_){const r=e.getUniformLocation(n,i(t,_));return l(r)?0:C(r)},n.wbg.__wbg_linkProgram_23751aba930c7f0c=function(e,n){e.linkProgram(n)},n.wbg.__wbg_pixelStorei_96bd9a13400d6b48=function(e,n,t){e.pixelStorei(n>>>0,t)},n.wbg.__wbg_shaderSource_580a31413cee6156=function(e,n,t,_){e.shaderSource(n,i(t,_))},n.wbg.__wbg_stencilFunc_0da3069a0a34d766=function(e,n,t,_){e.stencilFunc(n>>>0,t,_>>>0)},n.wbg.__wbg_stencilMask_34c2205b5355ab16=function(e,n){e.stencilMask(n>>>0)},n.wbg.__wbg_stencilOp_116522daccbe8b11=function(e,n,t,_){e.stencilOp(n>>>0,t>>>0,_>>>0)},n.wbg.__wbg_texParameteri_4774c5a61d70319d=function(e,n,t,_){e.texParameteri(n>>>0,t>>>0,_)},n.wbg.__wbg_uniform1f_f4314cbaa988e283=function(e,n,t){e.uniform1f(n,t)},n.wbg.__wbg_uniform1i_096d23b3f6d35c5e=function(e,n,t){e.uniform1i(n,t)},n.wbg.__wbg_useProgram_85e8d43a8983270e=function(e,n){e.useProgram(n)},n.wbg.__wbg_vertexAttribPointer_9cf4ab7e9c31e68d=function(e,n,t,_,r,b,c){e.vertexAttribPointer(n>>>0,t,_>>>0,0!==r,b,c)},n.wbg.__wbg_viewport_02810f5f49295b55=function(e,n,t,_,r){e.viewport(n,t,_,r)},n.wbg.__wbg_debug_68178c61250ae699="function"==typeof console.debug?console.debug:L("console.debug"),n.wbg.__wbg_error_e2677af4c7f31a14="function"==typeof console.error?console.error:L("console.error"),n.wbg.__wbg_info_2fe3b57d78190c6d="function"==typeof console.info?console.info:L("console.info"),n.wbg.__wbg_log_7761a8b8a8c1864e="function"==typeof console.log?console.log:L("console.log"),n.wbg.__wbg_warn_8b29c6b80217b0e4="function"==typeof console.warn?console.warn:L("console.warn"),n.wbg.__wbg_style_3fb37aa4b3701322=function(e){return e.style},n.wbg.__wbg_newwithbuffersourcesequenceandoptions_407953b12cf8d677=function(){return R((function(e,n){return new Blob(e,n)}),arguments)},n.wbg.__wbg_data_798d534e165849ee=function(e,n){const t=function(e,n){const t=n(1*e.length);return f().set(e,t/1),u=e.length,t}(n.data,b.__wbindgen_malloc),_=u;s()[e/4+1]=_,s()[e/4+0]=t},n.wbg.__wbg_newwithu8clampedarray_9c1ae19e8e194f7c=function(){return R((function(e,n,t){return new ImageData(I(e,n),t>>>0)}),arguments)},n.wbg.__wbg_instanceof_CanvasRenderingContext2d_9037c3eea625e27b=function(e){return e instanceof CanvasRenderingContext2D},n.wbg.__wbg_setglobalAlpha_3b2742cf3ea8149d=function(e,n){e.globalAlpha=n},n.wbg.__wbg_setglobalCompositeOperation_952c3106ecc5f417=function(){return R((function(e,n,t){e.globalCompositeOperation=i(n,t)}),arguments)},n.wbg.__wbg_setstrokeStyle_0ab7348da47291bb=function(e,n){e.strokeStyle=n},n.wbg.__wbg_setfillStyle_a0bd3a7496c1c5ae=function(e,n){e.fillStyle=n},n.wbg.__wbg_setfilter_3d603041d36eb024=function(e,n,t){e.filter=i(n,t)},n.wbg.__wbg_setimageSmoothingEnabled_3dbb2403930baf85=function(e,n){e.imageSmoothingEnabled=0!==n},n.wbg.__wbg_setlineWidth_5d6cf7ef78aab123=function(e,n){e.lineWidth=n},n.wbg.__wbg_setlineCap_7552a7f5a6cb2110=function(e,n,t){e.lineCap=i(n,t)},n.wbg.__wbg_setlineJoin_6b65f68b27c132a2=function(e,n,t){e.lineJoin=i(n,t)},n.wbg.__wbg_setmiterLimit_b9ee4cbfe23d8c23=function(e,n){e.miterLimit=n},n.wbg.__wbg_drawImage_83230048f8deee83=function(){return R((function(e,n,t,_){e.drawImage(n,t,_)}),arguments)},n.wbg.__wbg_clip_06e31c6883cedcea=function(e,n,t){e.clip(n,t)},n.wbg.__wbg_fill_b59d6423381669b5=function(e,n,t){e.fill(n,t)},n.wbg.__wbg_stroke_6345e439dce2411c=function(e,n){e.stroke(n)},n.wbg.__wbg_createLinearGradient_7e66eeec20a9f71e=function(e,n,t,_,r){return e.createLinearGradient(n,t,_,r)},n.wbg.__wbg_createPattern_f64be35193cf6d8a=function(){return R((function(e,n,t,_){const r=e.createPattern(n,i(t,_));return l(r)?0:C(r)}),arguments)},n.wbg.__wbg_createRadialGradient_bb0c3a1e9025fd4a=function(){return R((function(e,n,t,_,r,b,c){return e.createRadialGradient(n,t,_,r,b,c)}),arguments)},n.wbg.__wbg_getImageData_50f6c1b814306c32=function(){return R((function(e,n,t,_,r){return e.getImageData(n,t,_,r)}),arguments)},n.wbg.__wbg_putImageData_f71b039a7f3a0d8a=function(){return R((function(e,n,t,_){e.putImageData(n,t,_)}),arguments)},n.wbg.__wbg_clearRect_7d73f724a3fc825c=function(e,n,t,_,r){e.clearRect(n,t,_,r)},n.wbg.__wbg_fillRect_37d4341db168ab0f=function(e,n,t,_,r){e.fillRect(n,t,_,r)},n.wbg.__wbg_restore_2eda799771bbdaf3=function(e){e.restore()},n.wbg.__wbg_save_88e5b8eebd3f0de5=function(e){e.save()},n.wbg.__wbg_resetTransform_719b2c3de6d07521=function(){return R((function(e){e.resetTransform()}),arguments)},n.wbg.__wbg_setTransform_f6e32d675c5c5f30=function(){return R((function(e,n,t,_,r,b,c){e.setTransform(n,t,_,r,b,c)}),arguments)},n.wbg.__wbg_transform_441c583c742163e2=function(){return R((function(e,n,t,_,r,b,c){e.transform(n,t,_,r,b,c)}),arguments)},n.wbg.__wbg_addColorStop_c733d813c9fbfa70=function(){return R((function(e,n,t,_){e.addColorStop(n,i(t,_))}),arguments)},n.wbg.__wbg_inverse_b39ac63238937fb8=function(e){return e.inverse()},n.wbg.__wbg_baseURI_aca29593bfcdb51d=function(){return R((function(e,n){const t=n.baseURI;var _=l(t)?0:w(t,b.__wbindgen_malloc,b.__wbindgen_realloc),r=u;s()[e/4+1]=r,s()[e/4+0]=_}),arguments)},n.wbg.__wbg_appendChild_e9d52952defb480f=function(){return R((function(e,n){return e.appendChild(n)}),arguments)},n.wbg.__wbg_get_9ef6317e05999b24=function(){return R((function(e,n,t,_){const r=n[i(t,_)];var c=l(r)?0:w(r,b.__wbindgen_malloc,b.__wbindgen_realloc),o=u;s()[e/4+1]=o,s()[e/4+0]=c}),arguments)},n.wbg.__wbg_set_d76080869c49dd27=function(){return R((function(e,n,t,_,r){e[i(n,t)]=i(_,r)}),arguments)},n.wbg.__wbg_delete_27f2e31e06970b8b=function(){return R((function(e,n,t){delete e[i(n,t)]}),arguments)},n.wbg.__wbg_get_ad41fee29b7e0f53=function(e,n){return e[n>>>0]},n.wbg.__wbg_new_ee1a3da85465d621=function(){return new Array},n.wbg.__wbg_newnoargs_971e9a5abe185139=function(e,n){return new Function(i(e,n))},n.wbg.__wbg_next_3d0c4cc33e7418c9=function(){return R((function(e){return e.next()}),arguments)},n.wbg.__wbg_done_e5655b169bb04f60=function(e){return e.done},n.wbg.__wbg_value_8f901bca1014f843=function(e){return e.value},n.wbg.__wbg_get_72332cd2bc57924c=function(){return R((function(e,n){return Reflect.get(e,n)}),arguments)},n.wbg.__wbg_call_33d7bcddbbfa394a=function(){return R((function(e,n){return e.call(n)}),arguments)},n.wbg.__wbg_new_e6a9fecc2bf26696=function(){return new Object},n.wbg.__wbg_self_fd00a1ef86d1b2ed=function(){return R((function(){return self.self}),arguments)},n.wbg.__wbg_window_6f6e346d8bbd61d7=function(){return R((function(){return window.window}),arguments)},n.wbg.__wbg_globalThis_3348936ac49df00a=function(){return R((function(){return globalThis.globalThis}),arguments)},n.wbg.__wbg_global_67175caf56f55ca9=function(){return R((function(){return t.g.global}),arguments)},n.wbg.__wbg_isArray_a1a8c3a8ac24bdf1=function(e){return Array.isArray(e)},n.wbg.__wbg_of_85777d7b997ff4db=function(e,n){return Array.of(e,n)},n.wbg.__wbg_push_0bc7fce4a139a883=function(e,n){return e.push(n)},n.wbg.__wbg_instanceof_ArrayBuffer_02bbeeb60438c785=function(e){return e instanceof ArrayBuffer},n.wbg.__wbg_new_d9d91b97aceb0193=function(e){return new ArrayBuffer(e>>>0)},n.wbg.__wbg_values_830009b5edbb5836=function(e){return e.values()},n.wbg.__wbg_apply_769e865e14ecdbb0=function(){return R((function(e,n,t){return e.apply(n,t)}),arguments)},n.wbg.__wbg_call_65af9f665ab6ade5=function(){return R((function(e,n,t){return e.call(n,t)}),arguments)},n.wbg.__wbg_getTime_58b0bdbebd4ef11d=function(e){return e.getTime()},n.wbg.__wbg_getTimezoneOffset_8a39b51acb4f52c9=function(e){return e.getTimezoneOffset()},n.wbg.__wbg_new0_adda2d4bcb124f0a=function(){return new Date},n.wbg.__wbg_instanceof_Object_9657a9e91b05959b=function(e){return e instanceof Object},n.wbg.__wbg_entries_44c418612784cc9b=function(e){return Object.entries(e)},n.wbg.__wbg_fromEntries_576d8e028b09637c=function(){return R((function(e){return Object.fromEntries(e)}),arguments)},n.wbg.__wbg_is_43eb2f9708e964a9=function(e,n){return Object.is(e,n)},n.wbg.__wbg_new_52205195aa880fc2=function(e,n){try{var t={a:e,b:n};const _=new Promise(((e,n)=>{const _=t.a;t.a=0;try{return function(e,n,t,_){b.closure3309_externref_shim(e,n,t,_)}(_,t.b,e,n)}finally{t.a=_}}));return _}finally{t.a=t.b=0}},n.wbg.__wbg_resolve_0107b3a501450ba0=function(e){return Promise.resolve(e)},n.wbg.__wbg_then_18da6e5453572fc8=function(e,n){return e.then(n)},n.wbg.__wbg_then_e5489f796341454b=function(e,n,t){return e.then(n,t)},n.wbg.__wbg_buffer_34f5ec9f8a838ba0=function(e){return e.buffer},n.wbg.__wbg_new_cda198d9dbc6d7ea=function(e){return new Uint8Array(e)},n.wbg.__wbg_set_1a930cfcda1a8067=function(e,n,t){e.set(n,t>>>0)},n.wbg.__wbg_length_51f19f73d6d9eff3=function(e){return e.length},n.wbg.__wbg_newwithlength_66e5530e7079ea1b=function(e){return new Uint8Array(e>>>0)},n.wbg.__wbg_fill_8cddc41dd6a1c68e=function(e,n,t,_){return e.fill(n,t>>>0,_>>>0)},n.wbg.__wbg_subarray_270ff8dd5582c1ac=function(e,n,t){return e.subarray(n>>>0,t>>>0)},n.wbg.__wbg_ownKeys_406f07d243ada009=function(){return R((function(e){return Reflect.ownKeys(e)}),arguments)},n.wbg.__wbg_set_2762e698c2f5b7e0=function(){return R((function(e,n,t){return Reflect.set(e,n,t)}),arguments)},n.wbg.__wbindgen_debug_string=function(e,n){const t=w(y(n),b.__wbindgen_malloc,b.__wbindgen_realloc),_=u;s()[e/4+1]=_,s()[e/4+0]=t},n.wbg.__wbindgen_throw=function(e,n){throw new Error(i(e,n))},n.wbg.__wbindgen_memory=function(){return b.memory},n.wbg.__wbindgen_closure_wrapper902=function(e,n,t){return h(e,n,390,v)},n.wbg.__wbindgen_closure_wrapper904=function(e,n,t){return h(e,n,390,x)},n.wbg.__wbindgen_closure_wrapper906=function(e,n,t){return h(e,n,390,v)},n.wbg.__wbindgen_closure_wrapper908=function(e,n,t){return h(e,n,390,v)},n.wbg.__wbindgen_closure_wrapper910=function(e,n,t){return h(e,n,390,v)},n.wbg.__wbindgen_closure_wrapper912=function(e,n,t){return h(e,n,390,A)},n.wbg.__wbindgen_closure_wrapper6793=function(e,n,t){return h(e,n,2818,S)},n.wbg.__wbindgen_init_externref_table=function(){const e=b.__wbindgen_export_2,n=e.grow(4);e.set(0,void 0),e.set(n+0,void 0),e.set(n+1,null),e.set(n+2,!0),e.set(n+3,!1)},n}function B(e,n){return b=e.exports,j.__wbindgen_wasm_module=n,F=new Float32Array,m=new Float64Array,d=new Int32Array,E=new Uint32Array,o=new Uint8Array,O=new Uint8ClampedArray,b.__wbindgen_start(),b}function U(e){const n=W(),t=new WebAssembly.Module(e);return B(new WebAssembly.Instance(t,n),t)}async function j(e){void 0===e&&(e=new URL(t(285),t.b));const n=W();("string"==typeof e||"function"==typeof Request&&e instanceof Request||"function"==typeof URL&&e instanceof URL)&&(e=fetch(e));const{instance:_,module:r}=await async function(e,n){if("function"==typeof Response&&e instanceof Response){if("function"==typeof WebAssembly.instantiateStreaming)try{return await WebAssembly.instantiateStreaming(e,n)}catch(n){if("application/wasm"==e.headers.get("Content-Type"))throw n;console.warn("`WebAssembly.instantiateStreaming` failed because your server does not serve wasm with `application/wasm` MIME type. Falling back to `WebAssembly.instantiate` which is slower. Original error:\n",n)}const t=await e.arrayBuffer();return await WebAssembly.instantiate(t,n)}{const t=await WebAssembly.instantiate(e,n);return t instanceof WebAssembly.Instance?{instance:t,module:e}:t}}(await e,n);return B(_,r)}const q=j}}]);
//# sourceMappingURL=core.ruffle.a78640997e91152f6efc.js.map