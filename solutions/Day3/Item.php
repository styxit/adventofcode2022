<?php

namespace Solutions\Day3;

enum Item: int
{
    case a = 1;

    case b = 2;

    case c = 3;

    case d = 4;

    case e = 5;

    case f = 6;

    case g = 7;

    case h = 8;

    case i = 9;

    case j = 10;

    case k = 11;

    case l = 12;

    case m = 13;

    case n = 14;

    case o = 15;

    case p = 16;

    case q = 17;

    case r = 18;

    case s = 19;

    case t = 20;

    case u = 21;

    case v = 22;

    case w = 23;

    case x = 24;

    case y = 25;

    case z = 26;

    case A = 27;

    case B = 28;

    case C = 29;

    case D = 30;

    case E = 31;

    case F = 32;

    case G = 33;

    case H = 34;

    case I = 35;

    case J = 36;

    case K = 37;

    case L = 38;

    case M = 39;

    case N = 40;

    case O = 41;

    case P = 42;

    case Q = 43;

    case R = 44;

    case S = 45;

    case T = 46;

    case U = 47;

    case V = 48;

    case W = 49;

    case X = 50;

    case Y = 51;

    case Z = 52;

    public static function fromLetter(string $letter)
    {
        return constant("self::{$letter}");
    }
}
