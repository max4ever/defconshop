#!/bin/bash
#TODO delete when site is done

counter=1
for i in *.png
do
  echo "mv $i product$counter.png"
  mv $i product$counter.png
  let counter++
done
