#!/usr/bin/env python
# -*- coding: utf-8 -*-
import os
import sys
os.path.dirname(sys.executable)

# to transfer arabic number to english
import pyarabic.trans

import pandas as pd
import numpy as np
import tabula

# convert PDF into CSV file

passed=sys.argv[1] # passed will have the file name that will be processed
# "../data/StudentGPA.pdf" , ../data/StudentGPA.csv

# set prefix path to file and append file name to the tail of the string
inputtargetpath = "C:/xampp/htdocs/QU-Chatbot/storage/app/public/unprocessed_userfiles/" + passed + ".pdf"
outputtargetpath = "C:/xampp/htdocs/QU-Chatbot/storage/app/public/processed_userfiles/" + passed + ".csv"

tabula.convert_into(inputtargetpath , outputtargetpath, output_format="csv", pages='all')

df = pd.read_csv(outputtargetpath,  on_bad_lines='skip')

df = df[df['رمز المقرر'] !='رمز المقرر' ]

df["الساعات"] = df["الساعات"].astype(int)

# # thus it give me that i only have 118 hours

df["الساعات"].sum()

for ind , row in df.iterrows() :
    for i in df.columns :
        try:
            df[i][ind] = pyarabic.trans.normalize_digits(row[i])
        except:
            pass

df.to_csv(outputtargetpath , index=False)
