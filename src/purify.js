#!/usr/bin/env node
const createDOMPurify = require("dompurify");
const { JSDOM } = require("jsdom");
const fs = require("fs");

const window = new JSDOM("").window;
const DOMPurify = createDOMPurify(window);

let [dirtyPath, config] = process.argv.slice(2);

const dirty = fs.readFileSync(dirtyPath);
config = JSON.parse(Buffer.from(config, "base64").toString("ascii"));

if (config["ALLOWED_URI_REGEXP"]) {
  const main = config["ALLOWED_URI_REGEXP"].match(/\/(.+)\/.*/)[1];
  const options = config["ALLOWED_URI_REGEXP"].match(/\/.+\/(.*)/)[1];
  const regex = new RegExp(main, options);

  if (dirty.toString().search(regex) !== -1) {
    config["ALLOWED_URI_REGEXP"] = regex;
  }
}

const clean = DOMPurify.sanitize(dirty, config);

console.log(clean);
