#!/usr/bin/env python

import os
import sys
import enchant

d = enchant.request_pwl_dict("automarken.txt")
marke = d.suggest(sys.argv[1])

print marke[0].strip()