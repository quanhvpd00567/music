/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/wa.js":
/*!****************************!*\
  !*** ./resources/js/wa.js ***!
  \****************************/
/*! no static exports found */
/***/ (function(module, exports) {

var mContainer;
var mCamera, mRenderer;
var mControls;
var mScene;
var mParticleCount = 100000; // <-- change this number!

var mParticleSystem;
var mTime = 0.0;
var mTimeStep = 1 / 60;
var mDuration = 20;

window.onload = function () {
  init();
};

function init() {
  initTHREE();
  initControls();
  initParticleSystem();
  requestAnimationFrame(tick); // window.addEventListener('resize', resize, false);
}

function initTHREE() {
  mRenderer = new THREE.WebGLRenderer({
    antialias: true
  });
  mRenderer.setSize(window.innerWidth, window.innerHeight);
  mContainer = document.getElementById('three-container');
  mContainer.appendChild(mRenderer.domElement);
  mCamera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 5000);
  mCamera.position.set(0, 150, 400);
  mScene = new THREE.Scene();
  var light;
  light = new THREE.PointLight(0xffffff, 4, 1000, 2);
  light.position.set(0, 400, 0);
  mScene.add(light);
}

function initControls() {
  mControls = new THREE.OrbitControls(mCamera, mRenderer.domElement); // to disable zoom
  // mControls.enableZoom = false;

  mControls.enabled = false; // to disable rotation
  //     mControls.enableRotate = true;
  // to disable pan
  //     mControls.enablePan = false;
}

function initParticleSystem() {
  var prefabGeometry = new THREE.PlaneGeometry(4, 4);
  var bufferGeometry = new THREE.BAS.PrefabBufferGeometry(prefabGeometry, mParticleCount);
  bufferGeometry.computeVertexNormals(); // generate additional geometry data

  var aOffset = bufferGeometry.createAttribute('aOffset', 1);
  var aStartPosition = bufferGeometry.createAttribute('aStartPosition', 3);
  var aControlPoint1 = bufferGeometry.createAttribute('aControlPoint1', 3);
  var aControlPoint2 = bufferGeometry.createAttribute('aControlPoint2', 3);
  var aEndPosition = bufferGeometry.createAttribute('aEndPosition', 3);
  var aAxisAngle = bufferGeometry.createAttribute('aAxisAngle', 4);
  var aColor = bufferGeometry.createAttribute('color', 3);
  var i, j, offset; // buffer time offset

  var delay;

  for (i = 0, offset = 0; i < mParticleCount; i++) {
    delay = i / mParticleCount * mDuration;

    for (j = 0; j < prefabGeometry.vertices.length; j++) {
      aOffset.array[offset++] = delay;
    }
  } // buffer start positions


  var x, y, z;

  for (i = 0, offset = 0; i < mParticleCount; i++) {
    x = -1000;
    y = 0;
    z = 0;

    for (j = 0; j < prefabGeometry.vertices.length; j++) {
      aStartPosition.array[offset++] = x;
      aStartPosition.array[offset++] = y;
      aStartPosition.array[offset++] = z;
    }
  } // buffer control points


  for (i = 0, offset = 0; i < mParticleCount; i++) {
    x = THREE.Math.randFloat(-400, 400);
    y = THREE.Math.randFloat(400, 600);
    z = THREE.Math.randFloat(-1200, -800);

    for (j = 0; j < prefabGeometry.vertices.length; j++) {
      aControlPoint1.array[offset++] = x;
      aControlPoint1.array[offset++] = y;
      aControlPoint1.array[offset++] = z;
    }
  }

  for (i = 0, offset = 0; i < mParticleCount; i++) {
    x = THREE.Math.randFloat(-400, 400);
    y = THREE.Math.randFloat(-600, -400);
    z = THREE.Math.randFloat(800, 1200);

    for (j = 0; j < prefabGeometry.vertices.length; j++) {
      aControlPoint2.array[offset++] = x;
      aControlPoint2.array[offset++] = y;
      aControlPoint2.array[offset++] = z;
    }
  } // buffer end positions


  for (i = 0, offset = 0; i < mParticleCount; i++) {
    x = 1000;
    y = 0;
    z = 0;

    for (j = 0; j < prefabGeometry.vertices.length; j++) {
      aEndPosition.array[offset++] = x;
      aEndPosition.array[offset++] = y;
      aEndPosition.array[offset++] = z;
    }
  } // buffer axis angle


  var axis = new THREE.Vector3();
  var angle = 0;

  for (i = 0, offset = 0; i < mParticleCount; i++) {
    axis.x = THREE.Math.randFloatSpread(2);
    axis.y = THREE.Math.randFloatSpread(2);
    axis.z = THREE.Math.randFloatSpread(2);
    axis.normalize();
    angle = Math.PI * THREE.Math.randInt(16, 32);

    for (j = 0; j < prefabGeometry.vertices.length; j++) {
      aAxisAngle.array[offset++] = axis.x;
      aAxisAngle.array[offset++] = axis.y;
      aAxisAngle.array[offset++] = axis.z;
      aAxisAngle.array[offset++] = angle;
    }
  } // buffer color


  var color = new THREE.Color();
  var h, s, l;

  for (i = 0, offset = 0; i < mParticleCount; i++) {
    h = i / mParticleCount;
    s = THREE.Math.randFloat(0.4, 0.6);
    l = THREE.Math.randFloat(0.4, 0.6);
    color.setHSL(h, s, l);

    for (j = 0; j < prefabGeometry.vertices.length; j++) {
      aColor.array[offset++] = color.r;
      aColor.array[offset++] = color.g;
      aColor.array[offset++] = color.b;
    }
  }

  var material = new THREE.BAS.PhongAnimationMaterial( // custom parameters & THREE.MeshPhongMaterial parameters
  {
    vertexColors: THREE.VertexColors,
    shading: THREE.FlatShading,
    side: THREE.DoubleSide,
    uniforms: {
      uTime: {
        type: 'f',
        value: 0
      },
      uDuration: {
        type: 'f',
        value: mDuration
      }
    },
    shaderFunctions: [THREE.BAS.ShaderChunk['quaternion_rotation'], THREE.BAS.ShaderChunk['cubic_bezier']],
    shaderParameters: ['uniform float uTime;', 'uniform float uDuration;', 'attribute float aOffset;', 'attribute vec3 aStartPosition;', 'attribute vec3 aControlPoint1;', 'attribute vec3 aControlPoint2;', 'attribute vec3 aEndPosition;', 'attribute vec4 aAxisAngle;'],
    shaderVertexInit: ['float tProgress = mod((uTime + aOffset), uDuration) / uDuration;', 'float angle = aAxisAngle.w * tProgress;', 'vec4 tQuat = quatFromAxisAngle(aAxisAngle.xyz, angle);'],
    shaderTransformNormal: ['objectNormal = rotateVector(tQuat, objectNormal);'],
    shaderTransformPosition: ['transformed = rotateVector(tQuat, transformed);', 'transformed += cubicBezier(aStartPosition, aControlPoint1, aControlPoint2, aEndPosition, tProgress);']
  }, // THREE.MeshPhongMaterial uniforms
  {
    specular: 0xff0000,
    shininess: 20
  });
  mParticleSystem = new THREE.Mesh(bufferGeometry, material); // because the bounding box of the particle system does not reflect its on-screen size
  // set this to false to prevent the whole thing from disappearing on certain angles

  mParticleSystem.frustumCulled = false;
  mScene.add(mParticleSystem);
}

function tick() {
  update();
  render();
  mTime += mTimeStep;
  mTime %= mDuration;
  requestAnimationFrame(tick);
}

function update() {
  mControls.update();
  mParticleSystem.material.uniforms['uTime'].value = mTime;
}

function render() {
  mRenderer.render(mScene, mCamera);
}

function resize() {
  mCamera.aspect = window.innerWidth / window.innerHeight;
  mCamera.updateProjectionMatrix();
  mRenderer.setSize(window.innerWidth, window.innerHeight);
} /////////////////////////////
// buffer animation system
/////////////////////////////


THREE.BAS = {};
THREE.BAS.ShaderChunk = {};
THREE.BAS.ShaderChunk["animation_time"] = "float tDelay = aAnimation.x;\nfloat tDuration = aAnimation.y;\nfloat tTime = clamp(uTime - tDelay, 0.0, tDuration);\nfloat tProgress = ease(tTime, 0.0, 1.0, tDuration);\n";
THREE.BAS.ShaderChunk["cubic_bezier"] = "vec3 cubicBezier(vec3 p0, vec3 c0, vec3 c1, vec3 p1, float t)\n{\n    vec3 tp;\n    float tn = 1.0 - t;\n\n    tp.xyz = tn * tn * tn * p0.xyz + 3.0 * tn * tn * t * c0.xyz + 3.0 * tn * t * t * c1.xyz + t * t * t * p1.xyz;\n\n    return tp;\n}\n";
THREE.BAS.ShaderChunk["ease_in_cubic"] = "float ease(float t, float b, float c, float d) {\n  return c*(t/=d)*t*t + b;\n}\n";
THREE.BAS.ShaderChunk["ease_in_quad"] = "float ease(float t, float b, float c, float d) {\n  return c*(t/=d)*t + b;\n}\n";
THREE.BAS.ShaderChunk["ease_out_cubic"] = "float ease(float t, float b, float c, float d) {\n  return c*((t=t/d - 1.0)*t*t + 1.0) + b;\n}\n";
THREE.BAS.ShaderChunk["quaternion_rotation"] = "vec3 rotateVector(vec4 q, vec3 v)\n{\n    return v + 2.0 * cross(q.xyz, cross(q.xyz, v) + q.w * v);\n}\n\nvec4 quatFromAxisAngle(vec3 axis, float angle)\n{\n    float halfAngle = angle * 0.5;\n    return vec4(axis.xyz * sin(halfAngle), cos(halfAngle));\n}\n";

THREE.BAS.PrefabBufferGeometry = function (prefab, count) {
  THREE.BufferGeometry.call(this);
  this.prefabGeometry = prefab;
  this.prefabCount = count;
  this.prefabVertexCount = prefab.vertices.length;
  this.bufferDefaults();
};

THREE.BAS.PrefabBufferGeometry.prototype = Object.create(THREE.BufferGeometry.prototype);
THREE.BAS.PrefabBufferGeometry.prototype.constructor = THREE.BAS.PrefabBufferGeometry;

THREE.BAS.PrefabBufferGeometry.prototype.bufferDefaults = function () {
  var prefabFaceCount = this.prefabGeometry.faces.length;
  var prefabIndexCount = this.prefabGeometry.faces.length * 3;
  var prefabVertexCount = this.prefabVertexCount = this.prefabGeometry.vertices.length;
  var prefabIndices = [];

  for (var h = 0; h < prefabFaceCount; h++) {
    var face = this.prefabGeometry.faces[h];
    prefabIndices.push(face.a, face.b, face.c);
  }

  var indexBuffer = new Uint32Array(this.prefabCount * prefabIndexCount);
  var positionBuffer = new Float32Array(this.prefabCount * prefabVertexCount * 3);
  this.setIndex(new THREE.BufferAttribute(indexBuffer, 1));
  this.addAttribute('position', new THREE.BufferAttribute(positionBuffer, 3));

  for (var i = 0, offset = 0; i < this.prefabCount; i++) {
    for (var j = 0; j < prefabVertexCount; j++, offset += 3) {
      var prefabVertex = this.prefabGeometry.vertices[j];
      positionBuffer[offset] = prefabVertex.x;
      positionBuffer[offset + 1] = prefabVertex.y;
      positionBuffer[offset + 2] = prefabVertex.z;
    }

    for (var k = 0; k < prefabIndexCount; k++) {
      indexBuffer[i * prefabIndexCount + k] = prefabIndices[k] + i * prefabVertexCount;
    }
  }
};
/**
 * based on BufferGeometry.computeVertexNormals
 * calculate vertex normals for a prefab, and repeat the data in the normal buffer
 */


THREE.BAS.PrefabBufferGeometry.prototype.computeVertexNormals = function () {
  var index = this.index;
  var attributes = this.attributes;
  var positions = attributes.position.array;

  if (attributes.normal === undefined) {
    this.addAttribute('normal', new THREE.BufferAttribute(new Float32Array(positions.length), 3));
  }

  var normals = attributes.normal.array;
  var vA,
      vB,
      vC,
      pA = new THREE.Vector3(),
      pB = new THREE.Vector3(),
      pC = new THREE.Vector3(),
      cb = new THREE.Vector3(),
      ab = new THREE.Vector3();
  var indices = index.array;
  var prefabIndexCount = this.prefabGeometry.faces.length * 3;

  for (var i = 0; i < prefabIndexCount; i += 3) {
    vA = indices[i + 0] * 3;
    vB = indices[i + 1] * 3;
    vC = indices[i + 2] * 3;
    pA.fromArray(positions, vA);
    pB.fromArray(positions, vB);
    pC.fromArray(positions, vC);
    cb.subVectors(pC, pB);
    ab.subVectors(pA, pB);
    cb.cross(ab);
    normals[vA] += cb.x;
    normals[vA + 1] += cb.y;
    normals[vA + 2] += cb.z;
    normals[vB] += cb.x;
    normals[vB + 1] += cb.y;
    normals[vB + 2] += cb.z;
    normals[vC] += cb.x;
    normals[vC + 1] += cb.y;
    normals[vC + 2] += cb.z;
  }

  for (var j = 1; j < this.prefabCount; j++) {
    for (var k = 0; k < prefabIndexCount; k++) {
      normals[j * prefabIndexCount + k] = normals[k];
    }
  }

  this.normalizeNormals();
  attributes.normal.needsUpdate = true;
};

THREE.BAS.PrefabBufferGeometry.prototype.createAttribute = function (name, itemSize) {
  var buffer = new Float32Array(this.prefabCount * this.prefabVertexCount * itemSize);
  var attribute = new THREE.BufferAttribute(buffer, itemSize);
  this.addAttribute(name, attribute);
  return attribute;
}; // THREE.BAS.PrefabBufferGeometry.prototype.setAttribute4 = function (name, data) {
//     let offset = 0;
//     let array = this.geometry.attributes[name].array;
//     let i, j;
//
//     for (i = 0; i < data.length; i++) {
//         let v = data[i];
//
//         for (j = 0; j < this.prefabVertexCount; j++) {
//             array[offset++] = v.x;
//             array[offset++] = v.y;
//             array[offset++] = v.z;
//             array[offset++] = v.w;
//         }
//     }
//     console.log(111)
//
//     this.geometry.attributes[name].needsUpdate = true;
// };
// THREE.BAS.PrefabBufferGeometry.prototype.setAttribute3 = function (name, data) {
//     let offset = 0;
//     let array = this.geometry.attributes[name].array;
//     let i, j;
//     for (i = 0; i < data.length; i++) {
//         let v = data[i];
//
//         for (j = 0; j < this.prefabVertexCount; j++) {
//             array[offset++] = v.x;
//             array[offset++] = v.y;
//             array[offset++] = v.z;
//         }
//     }
//
//     this.geometry.attributes[name].needsUpdate = true;
// };


THREE.BAS.BaseAnimationMaterial = function (parameters) {
  THREE.ShaderMaterial.call(this);
  this.shaderFunctions = [];
  this.shaderParameters = [];
  this.shaderVertexInit = [];
  this.shaderTransformNormal = [];
  this.shaderTransformPosition = [];
  this.setValues(parameters);
};

THREE.BAS.BaseAnimationMaterial.prototype = Object.create(THREE.ShaderMaterial.prototype);
THREE.BAS.BaseAnimationMaterial.prototype.constructor = THREE.BAS.BaseAnimationMaterial;

THREE.BAS.BaseAnimationMaterial.prototype._concatFunctions = function () {
  return this.shaderFunctions.join('\n');
};

THREE.BAS.BaseAnimationMaterial.prototype._concatParameters = function () {
  return this.shaderParameters.join('\n');
};

THREE.BAS.BaseAnimationMaterial.prototype._concatVertexInit = function () {
  return this.shaderVertexInit.join('\n');
};

THREE.BAS.BaseAnimationMaterial.prototype._concatTransformNormal = function () {
  return this.shaderTransformNormal.join('\n');
};

THREE.BAS.BaseAnimationMaterial.prototype._concatTransformPosition = function () {
  return this.shaderTransformPosition.join('\n');
};

THREE.BAS.BaseAnimationMaterial.prototype.setUniformValues = function (values) {
  for (var key in values) {
    if (key in this.uniforms) {
      var uniform = this.uniforms[key];
      var value = values[key];

      switch (uniform.type) {
        case 'c':
          // color
          uniform.value.set(value);
          break;

        case 'v2': // vectors

        case 'v3':
        case 'v4':
          uniform.value.copy(value);
          break;

        case 'f': // float

        case 't':
          // texture
          uniform.value = value;
      }
    }
  }
};

THREE.BAS.PhongAnimationMaterial = function (parameters, uniformValues) {
  THREE.BAS.BaseAnimationMaterial.call(this, parameters);
  var phongShader = THREE.ShaderLib['phong'];
  this.uniforms = THREE.UniformsUtils.merge([phongShader.uniforms, this.uniforms]);
  this.lights = true;
  this.vertexShader = this._concatVertexShader();
  this.fragmentShader = phongShader.fragmentShader;
  uniformValues.map && (this.defines['USE_MAP'] = '');
  uniformValues.normalMap && (this.defines['USE_NORMALMAP'] = '');
  this.setUniformValues(uniformValues);
};

THREE.BAS.PhongAnimationMaterial.prototype = Object.create(THREE.BAS.BaseAnimationMaterial.prototype);
THREE.BAS.PhongAnimationMaterial.prototype.constructor = THREE.BAS.PhongAnimationMaterial;

THREE.BAS.PhongAnimationMaterial.prototype._concatVertexShader = function () {
  // based on THREE.ShaderLib.phong
  return ["#define PHONG", "varying vec3 vViewPosition;", "#ifndef FLAT_SHADED", "	varying vec3 vNormal;", "#endif", THREE.ShaderChunk["common"], THREE.ShaderChunk["uv_pars_vertex"], THREE.ShaderChunk["uv2_pars_vertex"], THREE.ShaderChunk["displacementmap_pars_vertex"], THREE.ShaderChunk["envmap_pars_vertex"], THREE.ShaderChunk["lights_phong_pars_vertex"], THREE.ShaderChunk["color_pars_vertex"], THREE.ShaderChunk["morphtarget_pars_vertex"], THREE.ShaderChunk["skinning_pars_vertex"], THREE.ShaderChunk["shadowmap_pars_vertex"], THREE.ShaderChunk["logdepthbuf_pars_vertex"], this._concatFunctions(), this._concatParameters(), "void main() {", this._concatVertexInit(), THREE.ShaderChunk["uv_vertex"], THREE.ShaderChunk["uv2_vertex"], THREE.ShaderChunk["color_vertex"], THREE.ShaderChunk["beginnormal_vertex"], this._concatTransformNormal(), THREE.ShaderChunk["morphnormal_vertex"], THREE.ShaderChunk["skinbase_vertex"], THREE.ShaderChunk["skinnormal_vertex"], THREE.ShaderChunk["defaultnormal_vertex"], "#ifndef FLAT_SHADED", // Normal computed with derivatives when FLAT_SHADED
  "	vNormal = normalize( transformedNormal );", "#endif", THREE.ShaderChunk["begin_vertex"], this._concatTransformPosition(), THREE.ShaderChunk["displacementmap_vertex"], THREE.ShaderChunk["morphtarget_vertex"], THREE.ShaderChunk["skinning_vertex"], THREE.ShaderChunk["project_vertex"], THREE.ShaderChunk["logdepthbuf_vertex"], "	vViewPosition = - mvPosition.xyz;", THREE.ShaderChunk["worldpos_vertex"], THREE.ShaderChunk["envmap_vertex"], THREE.ShaderChunk["lights_phong_vertex"], THREE.ShaderChunk["shadowmap_vertex"], "}"].join("\n");
};

/***/ }),

/***/ 1:
/*!**********************************!*\
  !*** multi ./resources/js/wa.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/macos/MyProject/php/music_all/resources/js/wa.js */"./resources/js/wa.js");


/***/ })

/******/ });