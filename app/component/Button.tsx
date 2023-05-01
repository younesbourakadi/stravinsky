'use client'

import { useRouter } from 'next/router';
import { useState } from 'react';


export default function Button() {
  return (
    <button className='bg-orange-500 text-2xl text-white font-bold rounded-3xl p-5'>Connect to Strava</button>
  )
}


